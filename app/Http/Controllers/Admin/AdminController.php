<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $admins = Admin::all();

        return view('admin.admins.index')->with('admins', $admins)->with('title', 'Всички администратори');
    }

    public function create()
    {
        $admins = Admin::all();

        return view('admin.admins.create')->with('users', $admins)->with('title', 'Нов администратор');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required',
            'password' => 'required',
        ]);

        $admin = new Admin;
        $admin->name     = $request->input('name');
        $admin->email    = $request->input('email');
        $admin->password = Hash::make($request->input('password'));
        $admin->save();

        return redirect('admin/admins')->with('message', 'Администратора е създатен');
    }

    public function show($id)
    {
        $admin = Admin::find($id);

        return view('admin.admins.show')->with('admin', $admin)->with('title', 'Преглед на администратор');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);

        return view('admin.admins.edit')->with('admin', $admin)->with('title', 'Промяна на администратор');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required',
            'password' => 'required',
        ]);

        $admin =  Admin::find($id);
        $admin->name     = $request->input('name');
        $admin->email    = $request->input('email');
        $admin->password = $request->input('password');
        $admin->save();

        return redirect('admin/admins')->with('message', 'Администратор е променент');
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();

        return redirect('admin/admins')->with('message', 'Админстратор изтрит');
    }
}
