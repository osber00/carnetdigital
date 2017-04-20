<?php

namespace Cdig\Http\Controllers;

use Illuminate\Http\Request;

use Cdig\Http\Requests;
use Cdig\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{

    public function getIndex()
    {
        return view('login');
    }

    public function postLoginAdmin(Request $request){
    	$rules = [
            'email' 	=> 'required',
            'password' 	=> 'required'
        ];

        $this->validate($request,$rules);

        $credentials = [
        	'email' => $request->get('email').'@cecar.edu.co',
            'password'  => $request->get('password'),
            'admin'    => 1
        ];
        
        if (Auth::attempt($credentials)){
            return redirect()->action('CarnetController@getIndex');
        }else{
            return back();
        }
    }

    public function getLogout()
    {
    	Auth::logout();
        return redirect()->action('LoginController@getIndex');
    }

    
}
