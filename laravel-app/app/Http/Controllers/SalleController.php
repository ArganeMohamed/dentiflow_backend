<?php
namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalleController extends Controller
{
    public function index()
    {
        $salles = Salle::all();
        if ($salles->count() > 0) {
            return response()->json([
                'status' => 200,
                'salles' => $salles
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
            'num_Salles' => 'required|string',
            'id_Medecin' => 'required|exists:medecins,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $salle = Salle::create([
                'num_Salles' => $request->num_Salles,
                'id_Medecin' => $request->id_Medecin,
            ]);

            if ($salle) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Salle created successfully'
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
        $salle = Salle::find($id);
        if ($salle) {
            return response()->json([
                'status' => 200,
                'salle' => $salle
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Salle found!'
            ], 404);
        }
    }

    public function edit($id)
    {
        $salle = Salle::find($id);
        if ($salle) {
            return response()->json([
                'status' => 200,
                'salle' => $salle
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Salle found!'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'num_Salles' => 'required|string',
            'id_Medecin' => 'required|exists:medecins,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $salle = Salle::find($id);

            if ($salle) {
                $salle->update([
                    'num_Salles' => $request->num_Salles,
                    'id_Medecin' => $request->id_Medecin,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Salle updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such Salle found!'
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $salle = Salle::find($id);
        if ($salle) {
            $salle->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Salle deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Salle found!'
            ], 404);
        }
    }
}

