<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller {

    public function index(Request $request): AnonymousResourceCollection {
        
        return UserResource::collection(User::with('profile')->paginate(1));
    
    }

    public function show(Request $request, User $user): UserResource {

        return new UserResource($user->load('profile'));

    }

}
