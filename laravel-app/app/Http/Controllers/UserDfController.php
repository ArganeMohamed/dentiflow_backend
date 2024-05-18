<?php

namespace App\Http\Controllers;

use App\Models\User_df;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserDfController extends Controller
{
    public function index()
    {
        $userDfs = User_df::all();
        if ($userDfs->count() > 0) {
            return response()->json([
                'status' => 200,
                'userDfs' => $userDfs
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:user_dfs',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,assistant,medecin',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $userDf = UserDf::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            if ($userDf) {
                return response()->json([
                    'status' => 200,
                    'message' => 'User created successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $userDf = UserDf::find($id);
        if ($userDf) {
            return response()->json([
                'status' => 200,
                'userDf' => $userDf
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such User found!'
            ], 404);
        }
    }

    public function edit($id)
    {
        $userDf = UserDf::find($id);
        if ($userDf) {
            return response()->json([
                'status' => 200,
                'userDf' => $userDf
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such User found!'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:user_dfs,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,assistant,medecin',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $userDf = UserDf::find($id);

            if ($userDf) {
                $userDf->name = $request->name;
                $userDf->email = $request->email;
                if ($request->password) {
                    $userDf->password = Hash::make($request->password);
                }
                $userDf->role = $request->role;
                $userDf->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'User updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such User found!'
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $userDf = UserDf::find($id);
        if ($userDf) {
            $userDf->delete();
            return response()->json([
                'status' => 200,
                'message' => 'User deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such User found!'
            ], 404);
        }
    }
}
