<?php
namespace App\Http\Controllers;

use App\Models\Assistant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssistantController extends Controller
{
    public function index()
    {
        $assistants = Assistant::all();
        if ($assistants->count() > 0) {
            return response()->json([
                'status' => 200,
                'assistants' => $assistants
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
            'nom_Assistant' => 'required|string|max:191',
            'prenom_Assistant' => 'required|string|max:191',
            'email_Assistant' => 'required|string|email|max:191|unique:assistants',
            'motPasse_Assistant' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $assistant = Assistant::create([
                'nom_Assistant' => $request->nom_Assistant,
                'prenom_Assistant' => $request->prenom_Assistant,
                'email_Assistant' => $request->email_Assistant,
                'motPasse_Assistant' => $request->motPasse_Assistant,
            ]);

            if ($assistant) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Assistant created successfully'
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
        $assistant = Assistant::find($id);
        if ($assistant) {
            return response()->json([
                'status' => 200,
                'assistant' => $assistant
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Assistant found!'
            ], 404);
        }
    }
    
    public function edit($id)
    {
        $assistant = Assistant::find($id);
        if ($assistant) {
            return response()->json([
                'status' => 200,
                'assistant' => $assistant
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Assistant found!'
            ], 404);
        }
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nom_Assistant' => 'required|string|max:191',
            'prenom_Assistant' => 'required|string|max:191',
            'email_Assistant' => 'required|string|email|max:191|unique:assistants,email,' . $id,
            'motPasse_Assistant' => 'required|string|max:191',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $assistant = Assistant::find($id);
    
            if ($assistant) {
                $assistant->update([
                    'nom_Assistant' => $request->nom_Assistant,
                    'prenom_Assistant' => $request->prenom_Assistant,
                    'email_Assistant' => $request->email_Assistant,
                    'motPasse_Assistant' => $request->motPasse_Assistant,
                ]);
    
                return response()->json([
                    'status' => 200,
                    'message' => 'Assistant updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such Assistant found!'
                ], 404);
            }
        }
    }
    
    public function destroy($id)
    {
        $assistant = Assistant::find($id);
        if ($assistant) {
            $assistant->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Assistant deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Assistant found!'
            ], 404);
        }
    }
}    
                   
