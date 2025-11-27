<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Resources\EnrollmentResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\EnrollmentStoreRequest;
use App\Models\User;

class EnrollmentController extends Controller {
    
    public function show(Enrollment $enrollment): EnrollmentResource {
        
        return new EnrollmentResource($enrollment->load(['payments']));

    }

    public function store(EnrollmentStoreRequest $request): EnrollmentResource {
        
        $validated = $request->validated();

        $validated['ip'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();
        
        $course = Course::where('id', '=', $validated['course_id'])->first();
        $user = User::where('id', '=', $validated['user_id'])->first();

        $enrollments = Enrollment::where('user_id', '=', $user->id)
                                 ->where('course_id', '=', $course->id)
                                 ->where(function(Builder $query) {
                                    
                                    return $query->where('status', '=', 'pending')
                                                 ->orWhere('status', '=', 'in_process')
                                                 ->orWhere('status', '=', 'approved'); 
                                 
                                 })
                                 ->count();

        if ($enrollments > 0) {

            throw new HttpException(409, 'Já há uma inscrição pendente, em processamento ou aprovada.');

        }
        
        $enrollment = DB::transaction(function() use ($validated, $course, $user) {
            
            $enrollment = Enrollment::create([
                'ip' => $validated['ip'],
                'user_agent' => $validated['user_agent'],
                'user_id' => $user->id,
                'course_id' => $course->id,
                'method' => 'pix',
                'currency' => 'BRL',
                'transaction_amount' => $course->price,
                'idempotency_key' => (string) Str::uuid(),
                'pix_email' => $user->email,
                'pix_expiration' => Carbon::now()->addHours(1),
            ]);
            
            return $enrollment;
        
        });

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('MP_ACCESS_TOKEN'),
            'X-Idempotency-Key' => (string) $enrollment->idempotency_key,
            ])->post("https://api.mercadopago.com/v1/payments", [
                'transaction_amount' => $enrollment->transaction_amount,
                'description' => sprintf('Inscrição no curso %s.', $course->name),
                'notification_url' => config('app.url') . route('api.enrollments.webhook', ['enrollment' => $enrollment->id], false),
                'external_reference' => $enrollment->id,
                'payment_method_id' => $enrollment->method,
                'date_of_expiration' => Carbon::parse($enrollment->pix_expiration)->format('Y-m-d\TH:i:s.vP'),
                'payer' => [
                    'email' => $enrollment->pix_email,
                ],
            ]);

        if (!$response->successful()) {
            
            Log::error($response);

            $enrollment->delete();

            return response()->json([
                'message' => 'Houve um erro durante a geração do pagamento. Tente novamente em instantes.',
            ], 502);
            
        }
        
        $responseData = $response->json();

        DB::transaction(function() use ($enrollment, $responseData) {
            
            $enrollment->transaction_id = $responseData['id'];
            
            $enrollment->status = $responseData['status'];
            $enrollment->status_detail = $responseData['status_detail'];
            
            $enrollment->pix_qr_code_base64 = $responseData['point_of_interaction']['transaction_data']['qr_code_base64'];
            $enrollment->pix_qr_code = $responseData['point_of_interaction']['transaction_data']['qr_code'];
            
            $enrollment->save();
        
        });

        return new EnrollmentResource($enrollment->load(['user', 'course']));

    }

    public function update(Request $request, Enrollment $enrollment) {
        
        $requestData = $request->json()->all();

        if ($requestData['action'] !== 'payment.updated') {

            return response()->json([], 200);

        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('MP_ACCESS_TOKEN'),
        ])->get("https://api.mercadopago.com/v1/payments/{$enrollment->transaction_id}");

        if (!$response->successful()) {
            
            Log::error($response);

            throw new HttpException(502, 'Não foi possível obter os dados do pagamento.');

        }

        $responseData = $response->json();

        DB::transaction(function() use ($enrollment, $responseData) {
            
            $enrollment->status = $responseData['status'];
            $enrollment->status_detail = $responseData['status_detail'];
            $enrollment->save();
        
        });
        
        return response()->json([], 200);

    }
    
    public function destroy(Enrollment $enrollment): JsonResponse {
        
        $enrollment->delete();

        return response()->json([
            'message' => 'A inscrição foi excluída.',
        ], 200);

    }

}
