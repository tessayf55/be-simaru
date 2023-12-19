<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::All();
        $ruangans = "Cek data";

        return view('users/index', compact('users', 'ruangans'));
    }

    public function create(){
        $roles = Role::All();
        return view('users/create', compact('roles'));
    }

    public function store(Request $request)
    {  
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,dev,owner,user',
        ]);
           
        $data = $request->all();
        // dd($data);
        $check = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' =>$data['role']
        ]);
         
        return redirect()->route('users.index')->withSuccess('Great! You have Successfully loggedin');
    }
}
