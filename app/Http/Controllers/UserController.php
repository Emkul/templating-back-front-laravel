<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(User $model)
    {

        return view('users.index', [
            'penggunas' => DB::table('users')->get(),
            'activePage' => 'Data users'
        ]);
    }

    public function create()
    {

        return view('users.create', [
            'user' => new User(),
            'submit' => 'Tambah'
        ]);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => ['required', 'unique:users,name'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','min:8'],
        ]);
        $data['password'] = bcrypt($data['password']);
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table('users')->insert($data);

        return redirect('/user');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => DB::table('users')->where('id', $user->id)->get()->first(),
            'submit' => 'Update'
        ]);
    }

    public function update(Request $request, $user)
    {

        $pwlama = DB::table('users')->where('id', $user)->get('password')->first();

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($pwlama->password != $data['password']) {
            $data['password'] = Hash::make($request->password);
            $data['updated_at'] = now();
            DB::table('users')->where('id', $user)->update($data);
        } else {
            $data['updated_at'] = now();
            DB::table('users')->where('id', $user)->update($data);
        }
        return redirect('user');
    }

    public function destroy($user)
    {

        DB::table('users')->where('id', $user)->delete();
        return back();
    }
}
