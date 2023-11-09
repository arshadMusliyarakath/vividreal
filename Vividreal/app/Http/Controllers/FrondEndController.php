<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class FrondEndController extends Controller
{
    public function home(){
        return redirect()->route('employees');
    }
    public function userLogin(){
        return view('login');
    }

    public function doLogin(){
        $data = [
            'email' => request('email'),
            'password' => request('password'),
        ];

        if(Auth::attempt($data)){
            return redirect()->route('home');
        }
        else{
            return redirect()->route('login')->with('loginFailedMessage', 'Invalid Credencials. Please try again!');
        }
    }

    public function userLogout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
