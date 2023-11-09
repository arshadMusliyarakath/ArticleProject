<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('author.login');
    }

    public function signup(){
        return view('author.signup');
    }

    public function doLogin(){
        $data = [
            'email' => request('email'),
            'password' => request('password'),
        ];
        $remember = (request('rememberToken')=='on') ? TRUE : FALSE;
        if(auth()->guard('author')->attempt($data, $remember)){
            return redirect()->route('dashboard');
        }
        else{
            return redirect()->route('author.login')->with('loginFailedMessage', 'Invalid Credencials. Please try again!');
        }
    }
    
    public function doSignup(){
        $data = [
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('pass1')),
        ];
        Author::create($data);
        return redirect()->route('author.login')->with('signupSuccess', "Accout Created! Please login now");
    }

    public function logout(){
        auth()->guard('author')->logout();
        return redirect()->route('author.login');
    }

}
