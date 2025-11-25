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
        $validated['password'] = bcrypt($validated['password']);

        if (isset($validated['photo'])) {

            $validated['photo'] = $validated['photo']->store('photos', 'public');

        }

        DB::transaction(function() use ($request, $validated) {
            
            $user = User::create($validated);
            $user->profile()->create($validated);
        
        });

        return response()->json([
            'message' => 'Usuário criado com sucesso.',
        ], 200);

    }

}
