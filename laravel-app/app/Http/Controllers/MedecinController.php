<?php
namespace App\Http\Controllers;

use App\Models\Medecin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedecinController extends Controller
{
    public function index()
    {
        $medecins = Medecin::all();
        if ($medecins->count() > 0) {
            return response()->json([
                'status' => 200,
                'medecins' => $medecins
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
            'nom_Medecin' => 'required|string|max:191',
            'prenom_Medecin' => 'required|string|max:191',
            'specialite' => 'required|string|max:191',
            'salle' => 'required|string|max:191',
            'mot_de_passe' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $medecin = Medecin::create([
                'nom_Medecin' => $request->nom_Medecin,
                'prenom_Medecin' => $request->prenom_Medecin,
                'specialite' => $request->specialite,
                'salle' => $request->salle,
                'mot_de_passe' => $request->mot_de_passe,
            ]);

            if ($medecin) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Medecin created successfully'
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
        $medecin = Medecin::find($id);
        if ($medecin) {
            return response()->json([
                'status' => 200,
                'medecin' => $medecin
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Medecin found!'
            ], 404);
        }
    }

    public function edit($id)
    {
        $medecin = Medecin::find($id);
        if ($medecin) {
            return response()->json([
                'status' => 200,
                'medecin' => $medecin
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Medecin found!'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nom_Medecin' => 'required|string|max:191',
            'prenom_Medecin' => 'required|string|max:191',
            'specialite' => 'required|string|max:191',
            'salle' => 'required|string|max:191',
            'mot_de_passe' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $medecin = Medecin::find($id);

            if ($medecin) {
                $medecin->update([
                    'nom_Medecin' => $request->nom_Medecin,
                    'prenom_Medecin' => $request->prenom_Medecin,
                    'specialite' => $request->specialite,
                    'salle' => $request->salle,
                    'mot_de_passe' => $request->mot_de_passe,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Medecin updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such Medecin found!'
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $medecin = Medecin::find($id);
        if ($medecin) {
            $medecin->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Medecin deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Medecin found!'
            ], 404);
        }
    }
}

