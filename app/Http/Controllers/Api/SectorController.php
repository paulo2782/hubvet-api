<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\sectorResource;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectorController extends Controller
{
    public function index()
    {
        $sector = Sector::all();
        return response(['data'=>sectorResource::collection($sector)]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:sectors|string|min:3|max:150'
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response(['messages'=>$validator->errors()]);
        }else{
            $sector = new Sector();
            $sector->name = $request->name;

            $sector->save();
        }
    }

    public function show(Sector $sector)
    {
        return response(['data'=>sectorResource::collection($sector)]);
    }

    public function update(Request $request, Sector $sector)
    {
        $rules = [
            'name' => 'required|unique:sectors|string|min:3|max:150'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response(['messages'=>$validator->errors()]);
        }else{
            $sector->update($request->all());
            return response(['message' => new sectorResource($sector), 'message' => 'OK'], 200);
        }
    }

    public function destroy(Sector $sector)
    {
        //
        $sector->delete();

        return response(['message' => 'Registro ID '.$sector->id.' Apagado']);
    }
}
