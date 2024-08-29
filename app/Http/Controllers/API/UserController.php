<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index()
    {
        $user = User::with('roles')->paginate(10);
        return $user->count() > 0 ? UserResource::collection($user) : response()->json(['message' => 'No user found'], 404);
    }

    public function getRoles()
    {
        $roles = Role::all();
        return response()->json($roles, 200);
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        $user->syncRoles($request->roles);

        return response()->json(['message' => 'Roles assigned successfully'], 200);
    }


}
