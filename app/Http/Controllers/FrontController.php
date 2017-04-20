<?php

namespace Cdig\Http\Controllers;

use Illuminate\Http\Request;
use Cdig\Http\Requests;
use Cdig\Http\Controllers\Controller;
use Cdig\User;

class FrontController extends Controller
{
    public function getIndex()
    {
        return view('info-error');
    }

    public function getQr($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('info',compact('user'));
        }else{
            return redirect()->action('FrontController@getIndex');
        }
    }
}
