<?php
namespace App\Http\Controllers;

use App\Models\Ordonance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdonanceController extends Controller
{
    public function index()
    {
        $ordonances = Ordonance::all();
        if ($ordonances->count() > 0) {
            return response()->json([
                'status' => 200,
                'ordonances' => $ordonances
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
            'date' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $ordonance = Ordonance::create([
                'date' => $request->date,
                'description' => $request->description,
            ]);

            if ($ordonance) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Ordonance created successfully'
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
        $ordonance = Ordonance::find($id);
        if ($ordonance) {
            return response()->json([
                'status' => 200,
                'ordonance' => $ordonance
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Ordonance found!'
            ], 404);
        }
    }

    public function edit($id)
    {
        $ordonance = Ordonance::find($id);
        if ($ordonance) {
            return response()->json([
                'status' => 200,
                'ordonance' => $ordonance
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Ordonance found!'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $ordonance = Ordonance::find($id);

            if ($ordonance) {
                $ordonance->update([
                    'date' => $request->date,
                    'description' => $request->description,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Ordonance updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such Ordonance found!'
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $ordonance = Ordonance::find($id);
        if ($ordonance) {
            $ordonance->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Ordonance deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such Ordonance found!'
            ], 404);
        }
    }
}
