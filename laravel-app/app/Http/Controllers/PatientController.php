<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        if ($patients->count() > 0) {
            return response()->json([
                'status' => 200,
                'patients' => $patients
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
            'nom' => 'required|string|max:191',
            'prenom' => 'required|string|max:191',
            'date_naissance' => 'required|date',
            'contact_info' => 'required|string|max:191',
            'id_Facture' => 'nullable|exists:factures,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $patient = Patient::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'date_naissance' => $request->date_naissance,
                'contact_info' => $request->contact_info,
                'id_Facture' => $request->id_Facture,
            ]);

            if ($patient) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Patient created successfully'
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
        $patient = Patient::find($id);
        if ($patient) {
            return response()->json([
                'status' => 200,
                'patient' => $patient
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Patient found!'
            ], 404);
        }
    }

    public function edit($id)
    {
        $patient = Patient::find($id);
        if ($patient) {
            return response()->json([
                'status' => 200,
                'patient' => $patient
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Patient found!'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:191',
            'prenom' => 'required|string|max:191',
            'date_naissance' => 'required|date',
            'contact_info' => 'required|string|max:191',
            'id_Facture' => 'nullable|exists:factures,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $patient = Patient::find($id);

            if ($patient) {
                $patient->update([
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'date_naissance' => $request->date_naissance,
                    'contact_info' => $request->contact_info,
                    'id_Facture' => $request->id_Facture,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Patient updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such Patient found!'
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);
        if ($patient) {
            $patient->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Patient deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Patient found!'
            ], 404);
        }
    }
}
