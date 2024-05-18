<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        if ($admins->count() > 0) {
            return response()->json([
                'status' => 200,
                'admins' => $admins
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
            'email' => 'required|string|email|max:191|unique:admins',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($admin) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Admin created successfully'
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
        $admin = Admin::find($id);
        if ($admin) {
            return response()->json([
                'status' => 200,
                'admin' => $admin
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Admin found!'
            ], 404);
        }
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            return response()->json([
                'status' => 200,
                'admin' => $admin
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Admin found!'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:admins,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $admin = Admin::find($id);

            if ($admin) {
                $admin->name = $request->name;
                $admin->email = $request->email;
                if ($request->password) {
                    $admin->password = Hash::make($request->password);
                }
                $admin->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Admin updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such Admin found!'
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $admin->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Admin deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Admin found!'
            ], 404);
        }
    }
}
