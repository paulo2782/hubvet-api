<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\productResource;
use App\Models\Product;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return response(['data'=>productResource::collection($product)]);
    }

    public function store(Request $request)
    {
        $rules = ['name' => 'required|string|min:3|max:150',
                'codebar'=>'required|unique:products|string|min:0|max:13',
                'value'=>'required|numeric|min:0',
                'id_user'=>'required|numeric',
                'id_sector'=>'required|numeric'
            ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response(['messages'=>$validator->errors()]);
        }else{
            $product = new Product();
            $product->name      = $request->name;
            $product->codebar   = $request->codebar;
            $product->value     = $request->value;
            $product->id_user   = $request->id_user; 
            $product->id_sector = $request->id_sector;

            $product->save();

            return response(['messages'=>'Registro Salvo!']);
        }
    }

    public function show(Product $product)
    {
        return response(['data'=>productResource::collection($product)]);
    }

    public function update(Request $request, Product $product)
    {
         $rules = ['name' => 'required|string|min:3|max:150',
                'codebar'=>'required|unique:products|string|min:0|max:13',
                'value'=>'required|numeric|min:0',
                'id_user'=>'required|numeric',
                'id_sector'=>'required|numeric'
            ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response(['messages'=>$validator->errors()]);
        }else{
            $product->update($request->all());
            return response(['message' => new productResource($product), 'message' => 'OK'], 200);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response(['message' => 'Registro ID '.$product->id.' Apagado']);
    }
}
