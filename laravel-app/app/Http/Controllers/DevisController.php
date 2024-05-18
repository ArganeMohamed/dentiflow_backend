<?php
namespace App\Http\Controllers;

use App\Models\Devis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DevisController extends Controller
{
    public function index()
    {
        $devis = Devis::all();
        if ($devis->count() > 0) {
            return response()->json([
                'status' => 200,
                'devis' => $devis
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
            'date_Devis' => 'required|date',
            'description_Devis' => 'nullable|string',
            'id_Patient' => 'required|exists:patients,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $devis = Devis::create([
                'date_Devis' => $request->date_Devis,
                'description_Devis' => $request->description_Devis,
                'id_Patient' => $request->id_Patient,
            ]);

            if ($devis) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Devis created successfully'
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
        $devis = Devis::find($id);
        if ($devis) {
            return response()->json([
                'status' => 200,
                'devis' => $devis
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Devis found!'
            ], 404);
        }
    }

    public function edit($id)
    {
        $devis = Devis::find($id);
        if ($devis) {
            return response()->json([
                'status' => 200,
                'devis' => $devis
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Devis found!'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date_Devis' => 'required|date',
            'description_Devis' => 'nullable|string',
            'id_Patient' => 'required|exists:patients,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $devis = Devis::find($id);

            if ($devis) {
                $devis->update([
                    'date_Devis' => $request->date_Devis,
                    'description_Devis' => $request->description_Devis,
                    'id_Patient' => $request->id_Patient,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Devis updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such Devis found!'
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $devis = Devis::find($id);
        if ($devis) {
            $devis->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Devis deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Devis found!'
            ], 404);
        }
    }
}
