<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Profile;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Mail\AccountConfirmationMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {

    public function index(Request $request): AnonymousResourceCollection {
        
        return UserResource::collection(User::with('profile')->paginate(10));
    
    }

    public function show(Request $request, User $user): UserResource {

        return new UserResource($user->load('profile'));

    }

    public function destroy(Request $request, User $user): JsonResponse {

        $user->delete();

        return response()->json([
            'message' => 'Usuário excluído com sucesso.',
        ], 200);

    }

    public function store(UserStoreRequest $request): JsonResponse {

        $validated = $request->validated();

        $validated['ip'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        if (isset($validated['photo'])) {

            $validated['photo'] = $validated['photo']->store('photos', 'public');

        }

        $user = DB::transaction(function() use ($request, $validated) {
            
            $user = User::create(Arr::only($validated, (new User())->getFillable()));
            $user->profile()->create(Arr::only($validated, (new Profile())->getFillable()));
        
            return $user;

        });

        if ((bool) $validated['email_confirmation'] === true) {

            dispatch(function() use ($user, $validated) {
                
                Mail::to($user->email)->send(new AccountConfirmationMail($user, $validated['password']));
            
            })->onQueue('confirmation');
        
        }

        return response()->json([
            'message' => 'Usuário criado com sucesso.',
        ], 201);

    }

    public function update(UserUpdateRequest $request, User $user): JsonResponse {

        $validated = $request->validated();

        $validated['ip'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        if (isset($validated['photo'])) {
            
            $validated['photo'] = $validated['photo']->store('photos', 'public');

            if ($user->profile->photo !== null && Storage::disk('public')->exists($user->profile->photo)) {

                Storage::disk('public')->delete($user->profile->photo);

            }
        
        }
        
        DB::transaction(function() use ($request, $user, $validated) {

            $user->update(Arr::only($validated, $user->getFillable()));
            
            $user->profile()->update(Arr::only($validated, $user->profile->getFillable()));
        
        });

        return response()->json([
            'message' => 'Usuário atualizado com sucesso.',
        ], 200);

    }

    public function removePhoto(Request $request, User $user): JsonResponse {

        if ($user->profile->photo !== null && Storage::disk('public')->exists($user->profile->photo)) {

            Storage::disk('public')->delete($user->profile->photo);

            DB::transaction(function() use ($user) {

                $user->profile->photo = null;
                $user->profile->save();

            });

            return response()->json([
                'message' => 'Foto removida com sucesso.',
            ], 200);

        }

        throw new HttpException(400, 'Não há foto para remover.');

    }

}
