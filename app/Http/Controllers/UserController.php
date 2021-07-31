<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //function to create new Admin
    public function create_admin(Request $request){
        //validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|confirmed',
        ]);
        
        //create new admin user
        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'client',
        ]);
        

        if($user != null){
            return $this->redirect_page("admin.add-admin","Admin Created Successfully!");
         } else{
             return $this->redirect_page("admin.add-admin","Error Creating Admin");
         }
    }

    //function for redirecting routes
    public function redirect_page($view, $msg = null){
        if($msg == null){
            return view($view);
        }
        return view($view, ['msg' => $msg]);
    }

    //function for authenticating admin
    public function login_admin(Request $request){

        $login = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        $remember_token = ($request['remember_token'] == true) ? true : false;
        if (Auth::guard('web')->attempt(['username' => $login['username'], 'password' => $login['password']])) {
             return response()->json(['success' => 'Login Successful!']);
            //echo "passed";
        } else {
             return response()->json(['error' => 'Invalid Login Details']);
            //echo "failed";
        }
        
    }

    public function logout(){

        Auth::logout();
        return redirect('/admin_login');
    }
}
