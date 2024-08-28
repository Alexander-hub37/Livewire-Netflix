<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        $user = User::paginate(10);
        return $user->count() > 0 ? UserResource::collection($user) : response()->json(['message' => 'No user found'], 404);
    }
}
