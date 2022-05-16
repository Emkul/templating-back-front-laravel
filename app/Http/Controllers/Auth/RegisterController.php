<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{


    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create()
    {
        return view('auth.register', ['title' => 'Register']);
    }

    public function store()
    {
        $atribut = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'min:8|required|confirmed',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $atribut['password'] = bcrypt(request('password'));

        DB::table('users')->insert( $atribut );

        Auth::attempt(request()->only('email', 'password'));
        
        return redirect('/home');
    }

}
