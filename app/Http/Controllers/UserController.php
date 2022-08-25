<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        try {
            $users = User::all();
            return response()->json([
                'success' => true,
                'data' => $users
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => `Data failed to fetch: {$th->getMessage()}`
            ]);
        }
    }

    public function view($id)
    {
        try {
            $user = User::find($id);
            return response()->json([
                'success' => true,
                'message' => 'Data has been successfully fetched',
                'data' => [
                    'nama' => $user->nama,
                    'isAccepted' => $user->isAccepted
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data: ' . $th->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $newUser = new User;
            $newUser->nama = $request->nama;
            $newUser->tempat_lahir = ucwords(strtolower($request->tempat_lahir));
            $newUser->tanggal_lahir = $request->tanggal_lahir;
            $newUser->alamat = $request->alamat;
            $newUser->no_telp = $request->no_telp;
            $newUser->save();

            return response()->json([
                'success' => true,
                'message' => 'Data has been successfully stored'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to store data: ' . $th->getMessage()
            ]);
        }
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        try {
            $user = User::find($id);
            if ($request->has('isAccepted')) {
                $user->isAccepted = $request->isAccepted;
            } else {
                $user->nama = $request->nama;
                $user->tempat_lahir = $request->tempat_lahir;
                $user->tanggal_lahir = $request->tanggal_lahir;
                $user->tanggal_lahir = $request->tanggal_lahir;
                $user->alamat = $request->alamat;
                $user->no_telp = $request->no_telp;
            }
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Data has been updated',
                'request' => $request->isAccepted
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update data: ' . $th->getMessage()
            ], 400);
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data has been deleted 😊'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => true,
                'message' => 'Failed to delete data 😓 : ' . $th->getMessage()
            ], 400);
        }
    }
}
