<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $admin = Admin::where('username', $username)->first();
        if($admin) {
            if (Hash::check($password, $admin->password)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login Successfully',
                    'role' => 'admin',
                    'data' => [
                        'username' => $admin->username,
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Wrong Password'
                ], 404);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'User Not Found'
        ], 404);
    }
}
