<?php
namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::all();
        if ($factures->count() > 0) {
            return response()->json([
                'status' => 200,
                'factures' => $factures
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
            'montant_total' => 'required|numeric',
            'statut' => 'required|string|max:191',
            'id_Ordanance' => 'required|exists:ordonances,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $facture = Facture::create([
                'montant_total' => $request->montant_total,
                'statut' => $request->statut,
                'id_Ordanance' => $request->id_Ordanance,
            ]);

            if ($facture) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Facture created successfully'
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
        $facture = Facture::find($id);
        if ($facture) {
            return response()->json([
                'status' => 200,
                'facture' => $facture
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Facture found!'
            ], 404);
        }
    }

    public function edit($id)
    {
        $facture = Facture::find($id);
        if ($facture) {
            return response()->json([
                'status' => 200,
                'facture' => $facture
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Facture found!'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'montant_total' => 'required|numeric',
            'statut' => 'required|string|max:191',
            'id_Ordanance' => 'required|exists:ordonances,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $facture = Facture::find($id);

            if ($facture) {
                $facture->update([
                    'montant_total' => $request->montant_total,
                    'statut' => $request->statut,
                    'id_Ordanance' => $request->id_Ordanance,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Facture updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such Facture found!'
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $facture = Facture::find($id);
        if ($facture) {
            $facture->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Facture deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Facture found!'
            ], 404);
        }
    }
}

