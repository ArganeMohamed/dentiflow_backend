<?php

namespace App\Http\Controllers;
use App\Models\Appareil;
use Illuminate\Http\Request;

class AppareilController extends Controller
{
    public function index()
    {
        $appareils = Appareil::all();
        if($appareils->count() >0){
            return response()->json([
                'status'=>200,
                'appareils'=>$appareils
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'No Records Found'
            ],404);
        }
    }

    public function store(Request $request){
        $validator = validator::make($request->all(), [
            'nom_Appareil' => 'required|string|max:191',
            'description_Appareil' => 'required|string|max:191',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $appareil = Appareil::create([
                'nom_Appareil' => $request->nom_Appareil,
                'description_Appareil' => $request->description_Appareil,
            ]);
    
            if ($appareil) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Appareil created successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        } 
    }
    public function show($id){
          $appareil =Appareil::find($id);
          if($appareil){

            return response()->json([
                'status' => 200,
                 'message' => $appareil
            ],200);

          } else{
            return response()->json([
                'status' => 404,
                 'message' => 'No such Appareil found!'
            ],404);
          } 
    }
    public function edit($id){
        $appareil =Appareil::find($id);
        if($appareil){

          return response()->json([
              'status' => 200,
               'message' => $appareil
          ],200);

        } else{
          return response()->json([
              'status' => 404,
               'message' => 'No such Appareil found!'
          ],404);
        } 
    }
    public function update(Request $request, int $id){
        $validator = validator::make($request->all(), [
            'nom_Appareil' => 'required|string|max:191',
            'description_Appareil' => 'required|string|max:191',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $appareil = Appareil::find($id);

            if ($appareil) {

                
            $appareil->update([
                'nom_Appareil' => $request->nom_Appareil,
                'description_Appareil' => $request->description_Appareil,
            ]);
    

                return response()->json([
                    'status' => 200,
                    'message' => 'Appareil updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such Appareil found !'
                ], 404);
            }
        } 
    }
    public function destory($id){
        $appareil =Appareil::find($id);
        if($appareil){
            $appareil->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Appareil Deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No such Appareil found !'
            ], 404);
        }
    }
}
