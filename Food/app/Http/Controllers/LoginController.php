<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            
            if(Auth::attempt(['email'=>$request->email,'password'=> $request->password])){

            }else{
                return redirect()->route('account.login')->with('Either email or password is incorrect.');
            }

        } else{
            return redirect()->route('account.login')
            ->withInput() 
            ->withErrors($validator);

        }

    }
    public function register(){
        return view('register');
    }


    public function processRegister(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        if ($validator->passes()) {
            
            if(Auth::attempt(['email'=>$request->email,'password'=> $request->password])){

            }else{
                return redirect()->route('account.login')->with('Either email or password is incorrect.');
            }

        } else{
            return redirect()->route('account.register')
            ->withInput() 
            ->withErrors($validator);

        }

        return view('register');
    }
}
