<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
 
class AuthController extends Controller
{
	 
    public function register(Request $request)
    {
    
		$rules = [
				'name' => 'required|string|min:3|max:150',
				'email'=> 'required|max:150',
				'user' => 'required|string|min:3|max:25',
				'cnpj' => 'present|nullable|min:0|max:18',
				'accredited'=>'required|string|min:3',
				'password'=>'required|confirmed|min:6'
		];
		
		$validator = Validator::make($request->all(), $rules);

		$query = User::where('user',$request->user)
					->where('accredited',$request->accredited)
					->count();

		if($query == 0){
			if($validator->fails()){
				return response(['messages'=>$validator->errors()]);
			}else{
		        $user = new User();
		        $user->name 		= $request->name;
		        $user->user 		= $request->user;
		        $user->accredited 	= $request->accredited;
		        $user->email 		= $request->email;
		        $user->password 	= bcrypt($request->password);
		        $user->save();

		        $accessToken = $user->createToken('authToken')->accessToken;
	            return response([ 'user' => $user, 'access_token' => $accessToken]);
	        }
	    }else{
	    	return response(['error'=>'Usuário já cadastrado para esse estabelecimento.']);
	    }     
	}

	public function login(Request $request)
	{
		$rules = [
				'accredited'=>'required|string|min:3',
				'user' => 'required|string|min:3|max:25',
				'password'=>'required|min:6'
		];
		
		$validator = Validator::make($request->all(), $rules);
		
		if($validator->fails()){
			return response(['messages'=>$validator->errors()]);
		}

		$loginData = $request->all();
		if (!auth()->attempt($loginData)) {
            return response(['message' => 'Usuario inválido para o credenciado']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);      
    }

}
