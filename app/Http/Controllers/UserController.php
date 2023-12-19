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

    public function edit($id)
    {   
        $user = User::where('id', $id)->first();
        $roles = Role::All();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(User $user, Request $request)
    {   
        $data = User::where('id', $id);

        $data->name = $request->name;
        $data->email = $request->email;

        $data->save();
        
        return redirect()->route('users.index')->withSuccess('Great! You have Successfully loggedin');
    }

}
