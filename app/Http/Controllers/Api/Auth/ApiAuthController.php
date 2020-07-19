<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

// Facades
use Illuminate\Support\Facades\Hash;

// Models
use App\User;

// Resources
use App\Http\Resources\User\UserLoginResource;

class ApiAuthController extends Controller
{

    public function loginApi(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        $newUser = User::where('id', $user->id)->first();

        return response()->json(['data' => new UserLoginResource($newUser)], 200);
    }

    public function registerApi(Request $request)
    {
        // return response()->json(['data' => $request->toArray()], 500);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'cnic' => ['required'],
            'phone_number' => ['required'],
            'role' => ['required'] // 'hall_manager', 'customer'
        ]);

        $UserRole = 'customer';
        if ($request->has('role')) {
            $UserRole = $request->role;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'cnic' => $request->cnic,
            'location' => $request->location,
            'role' => $UserRole
        ]);

        return response()->json(['data' => new UserLoginResource($user)], 200);
    }

    public function logoutApi(Request $request)
    {
        $request->session()->flush();
        $request->user()->tokens()->delete();

        return response()->json(['data' => 'User Tokkens Deleted'], 200);
    }

    public function checkLoginStatus(Request $request)
    {
        if ($request->user()) {
            response()->json(['data' => 'Working!'], 200);
        }
        response()->json(['message' => 'Eror Occured!'], 500);
    }
}