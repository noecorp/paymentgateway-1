<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function addUser(Request $request){		
		$validator = \Validator::make($request->all(), 
		[
			'FirstName' => 'required',
			'LastName' => 'required',
			'BusinessName' => 'required',
			'AddressLine1' => 'required',
			'City' => 'required',
			'State' => 'required',
			'ZipCode' => 'required',
			'Phone' => 'required',
			'TypeOfBusiness' => 'required',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required'
		]
		);
		
		if($validator->fails()) {
			return response()->json(['Status'=>0,'Description'=>$validator->errors()]);
        }else{
			if($request->input('AddressLine2')){
				$AddressLine2=$request->input('AddressLine2');
			}else{
				$AddressLine2="";
			}
			$user=User::create([
				'name' => $request->input('FirstName')." ".$request->input('LastName'),
				'FirstName' => $request->input('FirstName'),
				'LastName' => $request->input('LastName'),
				'BusinessName' => $request->input('BusinessName'),
				'AddressLine1' => $request->input('AddressLine1'),
				'AddressLine2' => $AddressLine2,
				'City' => $request->input('City'),
				'State' => $request->input('State'),
				'ZipCode' => $request->input('ZipCode'),
				'Phone' => $request->input('Phone'),
				'TypeOfBusiness' => $request->input('TypeOfBusiness'),
				'email' => $request->input('email'),
				'password' => $request->input('password')
			]);
			return response()->json(['Status'=>1,'Description'=>'User Successfully created.']);
		}
		
		
	}
}
