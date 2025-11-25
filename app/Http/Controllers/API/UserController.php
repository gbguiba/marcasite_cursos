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
            'message' => 'Usuário excluído.',
        ], 200);

    }

    public function store(UserStoreRequest $request): JsonResponse {

        $validated = $request->validated();

        DB::transaction(function() use ($request, $validated) {

            $user = new User();
            $user->id = (string) Str::uuid();
            $user->ip = $request->ip();
            $user->user_agent = $request->userAgent();
            $user->type = $validated['type'];
            $user->email = $validated['email'];
            $user->password = bcrypt($validated['password']);
            $user->active = true;
            $user->save();

            $profile = new Profile();
            $profile->id = (string) Str::uuid();
            $profile->ip = $request->ip();
            $profile->user_agent = $request->userAgent();
            $profile->user_id = $user->id;
            $profile->name = $validated['name'];
            $profile->photo_path = isset($validated['photo']) ? $validated['photo']->store('photos', 'public') : null;
            $profile->cpf = $validated['cpf'];
            $profile->save();

        });

        return response()->json([
            'message' => 'Usuário criado com sucesso.',
        ], 200);

    }

}
