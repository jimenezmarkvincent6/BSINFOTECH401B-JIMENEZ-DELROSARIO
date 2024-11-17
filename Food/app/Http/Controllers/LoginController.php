<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('account.login');
    }
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            
            if(Auth::attempt(['email'=>$request->email,'password'=> $request->password])){
                return redirect()->route('products.index');
            }else{
                return redirect()->route('account.login')->with('error','Either email or password is incorrect.');
            }

        } else{
            return redirect()->route('account.login')
            ->withInput() 
            ->withErrors($validator);

        }

    }
    public function register(){
        return view('account.register');
    }


    public function processRegister(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        if ($validator->passes()) {
            
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('account.login')->with('success','You have registered!');

        } else{
            return redirect()->route('account.register')
            ->withInput() 
            ->withErrors($validator);

        }

        return view('account.register');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }
    public function admin()
    {
        $users = User::all(); 
        return view('account.admin', compact('users'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('account.admin')->with('success', 'Account deleted successfully.');
    }
    public function edited()
    {
        $user = Auth::user(); 
        return view('account.edited', compact('user'));
    }
    public function updated(Request $request, $id)
    {
        $user = User::findOrFail($id);


        $rules = [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed',
        ];

      
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('account.edited', $user->id)
                            ->withInput()
                            ->withErrors($validator);
        }

   
        $user->name = $request->name;
        $user->email = $request->email;

     
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('account.admin')->with('success', 'Account updated successfully!');
    }



}   
