<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // try {
            $no_telp = trim($request->no_telp);
            $nama = strtolower(trim($request->nama));

            $user = User::where('nama', $nama)->where('no_telp', $no_telp)->first();

            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Login',
                    'data' => [
                        'id' => $user->id
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No Handphone atau Nama Salah'
            ]);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Something went wrong: ' . $th->getMessage()
        //     ]);
        // }
    }
}
