<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $users = User::all();

        return view('admin.users.index')->with('users', $users)->with('title', 'Всички потребители');
    }

    public function create()
    {
        $users = User::all();

        return view('admin.users.create')->with('users', $users)->with('title', 'Създаване на потребител');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email'        => 'required',
            'password'  => 'required',
        ]);

        $user =  new User;
        $user->name     = $request->input('name');
        $user->email    = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect('admin/users')->with('success', 'Потребителя е създаден');
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('admin.users.show')->with('user', $user)->with('title', 'Преглед на потребител');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit')->with('user', $user)->with('title', 'Обновяване на потребител');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'    => 'required',
            'email'   => 'required',
            'password'=> 'required',
        ]);

        $user =  User::find($id);
        $user->name = $request->input('name');
        $user->email        = $request->input('email');
        $user->password  = $request->input('password');
        $user->save();

        return redirect('admin/users')->with('success', 'Потребител е обновен');
    }

    public function destroy($id)
    {
        $user =  User::find($id);
        $user->delete();

        return redirect('admin/users')->with('success', 'Потребител е изтрит');
    }
}
