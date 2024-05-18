<?php
namespace App\Http\Controllers;

use App\Models\Traitement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TraitementController extends Controller
{
    public function index()
    {
        $traitements = Traitement::all();
        if ($traitements->count() > 0) {
            return response()->json([
                'status' => 200,
                'traitements' => $traitements
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
            'dent' => 'nullable|string',
            'description' => 'required|string',
            'cout' => 'required|numeric',
            'id_Devis' => 'required|exists:devis,id',
            'id_Facture' => 'required|exists:factures,id',
            'id_Ordanance' => 'required|exists:ordonances,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $traitement = Traitement::create([
                'dent' => $request->dent,
                'description' => $request->description,
                'cout' => $request->cout,
                'id_Devis' => $request->id_Devis,
                'id_Facture' => $request->id_Facture,
                'id_Ordanance' => $request->id_Ordanance,
            ]);

            if ($traitement) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Traitement created successfully'
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
        $traitement = Traitement::find($id);
        if ($traitement) {
            return response()->json([
                'status' => 200,
                'traitement' => $traitement
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Traitement found!'
            ], 404);
        }
    }

    public function edit($id)
    {
        $traitement = Traitement::find($id);
        if ($traitement) {
            return response()->json([
                'status' => 200,
                'traitement' => $traitement
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Traitement found!'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'dent' => 'nullable|string',
            'description' => 'required|string',
            'cout' => 'required|numeric',
            'id_Devis' => 'required|exists:devis,id',
            'id_Facture' => 'required|exists:factures,id',
            'id_Ordanance' => 'required|exists:ordonances,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $traitement = Traitement::find($id);

            if ($traitement) {
                $traitement->update([
                    'dent' => $request->dent,
                    'description' => $request->description,
                    'cout' => $request->cout,
                    'id_Devis' => $request->id_Devis,
                    'id_Facture' => $request->id_Facture,
                    'id_Ordanance' => $request->id_Ordanance,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Traitement updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such Traitement found!'
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $traitement = Traitement::find($id);
        if ($traitement) {
            $traitement->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Traitement deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Traitement found!'
            ], 404);
        }
    }
}


