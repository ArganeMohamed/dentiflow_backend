<?php
namespace App\Http\Controllers;

use App\Models\Rendez_vous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RendezVousController extends Controller
{
    public function index()
    {
        $rendezvouses = Rendez_vous::all();
        if ($rendezvouses->count() > 0) {
            return response()->json([
                'status' => 200,
                'rendezvouses' => $rendezvouses
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
            'date' => 'required|date',
            'id_Ordanance' => 'required|exists:ordonances,id',
            'id_Medecin' => 'required|exists:medecins,id',
            'id_Patient' => 'required|exists:patients,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $rendezvous = RendezVous::create([
                'date' => $request->date,
                'id_Ordanance' => $request->id_Ordanance,
                'id_Medecin' => $request->id_Medecin,
                'id_Patient' => $request->id_Patient,
            ]);

            if ($rendezvous) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Rendez-vous created successfully'
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
        $rendezvous = RendezVous::find($id);
        if ($rendezvous) {
            return response()->json([
                'status' => 200,
                'rendezvous' => $rendezvous
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Rendez-vous found!'
            ], 404);
        }
    }

    public function edit($id)
    {
        $rendezvous = RendezVous::find($id);
        if ($rendezvous) {
            return response()->json([
                'status' => 200,
                'rendezvous' => $rendezvous
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Rendez-vous found!'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'id_Ordanance' => 'required|exists:ordonances,id',
            'id_Medecin' => 'required|exists:medecins,id',
            'id_Patient' => 'required|exists:patients,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $rendezvous = RendezVous::find($id);

            if ($rendezvous) {
                $rendezvous->update([
                    'date' => $request->date,
                    'id_Ordanance' => $request->id
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'rendezvous updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such rendezvous found!'
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $rendezvous = Patient::find($id);
        if ($rendezvous) {
            $rendezvous->delete();
            return response()->json([
                'status' => 200,
                'message' => 'rendezvous deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such rendezvous found!'
            ], 404);
        }
    }
}
