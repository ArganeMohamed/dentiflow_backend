<?php
namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::all();
        if ($paiements->count() > 0) {
            return response()->json([
                'status' => 200,
                'paiements' => $paiements
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
            'montant' => 'required|numeric',
            'mode' => 'required|string|max:191',
            'date' => 'required|date',
            'id_Facture' => 'required|exists:factures,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $paiement = Paiement::create([
                'montant' => $request->montant,
                'mode' => $request->mode,
                'date' => $request->date,
                'id_Facture' => $request->id_Facture,
            ]);

            if ($paiement) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Paiement created successfully'
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
        $paiement = Paiement::find($id);
        if ($paiement) {
            return response()->json([
                'status' => 200,
                'paiement' => $paiement
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Paiement found!'
            ], 404);
        }
    }

    public function edit($id)
    {
        $paiement = Paiement::find($id);
        if ($paiement) {
            return response()->json([
                'status' => 200,
                'paiement' => $paiement
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Paiement found!'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'montant' => 'required|numeric',
            'mode' => 'required|string|max:191',
            'date' => 'required|date',
            'id_Facture' => 'required|exists:factures,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $paiement = Paiement::find($id);

            if ($paiement) {
                $paiement->update([
                    'montant' => $request->montant,
                    'mode' => $request->mode,
                    'date' => $request->date,
                    'id_Facture' => $request->id_Facture,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Paiement updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such Paiement found!'
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $paiement = Paiement::find($id);
        if ($paiement) {
            $paiement->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Paiement deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Paiement found!'
            ], 404);
        }
    }
}

