<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\InfoCompany;
use Illuminate\Support\Facades\Storage;

class InfoCompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $infoCompany = InfoCompany::orderBy('created_at', 'desc')->first();

        return view('admin.info_company.index')->with('info_company', $infoCompany)->with('title', 'Информациа за сайта');
    }

    public function create()
    {
        return view('admin.info_company.create')->with('title', 'Създаване информация за сайта');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_company' => 'required',
            'phone_com'    => 'required',
            'email_com'    => 'required',
        ]);

        if($request->hasFile('upload_logo_picture'))
        {
            $extension = $request->file('upload_logo_picture')->getClientOriginalExtension();
            $fileNameToStore = 'logo.'.$extension;
            $path = $request->file('upload_logo_picture')->storeAs('public/common_pictures/', $fileNameToStore);
            $logo_name = $fileNameToStore;
        }
        else
        {
            $logo_name = '';
        }

        $infoCompany = new InfoCompany();
        $infoCompany->name_company    = $request->input('name_company');
        $infoCompany->address_com     = $request->input('address_com');
        $infoCompany->email_com       = $request->input('email_com');
        $infoCompany->phone_com       = $request->input('phone_com');
        $infoCompany->logo_com        = $logo_name;
        $infoCompany->work_time_com   = $request->input('work_time_com');
        $infoCompany->description_com = $request->input('description_com');
        $infoCompany->map_com         = $request->input('map_com');
        $infoCompany->save();

        return redirect('/admin/info_company')->with('success', 'Информациата за сайта е създадена')->with('title', 'Информация за сайта');
    }

    public function edit($id)
    {
        $infoCompany = InfoCompany::find($id);

        return view('admin.info_company.edit')->with('info_company',  $infoCompany)->with('title', 'Промяна информацията за сайта');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name_company' => 'required',
            'phone_com'    => 'required',
            'email_com'    => 'required',
        ]);

        if($request->hasFile('upload_logo_picture'))
        {
            $extension = $request->file('upload_logo_picture')->getClientOriginalExtension();
            $fileNameToStore = 'logo.'.$extension;
            $path = $request->file('upload_logo_picture')->storeAs('public/common_pictures/', $fileNameToStore);
            $logo_name = $fileNameToStore;
        }
        else
        {
            $logo_name = '';
        }

        $infoCompany = InfoCompany::find($id);
        $infoCompany->name_company    = $request->input('name_company');
        $infoCompany->address_com     = $request->input('address_com');
        $infoCompany->email_com       = $request->input('email_com');
        $infoCompany->phone_com       = $request->input('phone_com');
        $infoCompany->logo_com        = $logo_name;
        $infoCompany->work_time_com   = $request->input('work_time_com');
        $infoCompany->description_com = $request->input('description_com');
        $infoCompany->map_com         = $request->input('map_com');
        $infoCompany->save();

        return redirect('/admin/info_company')->with('success', 'Информацията за сайта е променена')->with('title', 'Информация за сайта');
    }


    public function destroy($id)
    {
        $infoCompany = InfoCompany::find($id);
        $infoCompany->delete();
        Storage::delete('public/common_pictures/logo.png');

        return redirect('/admin/info_company')->with('success', 'Информациата за сайта е ');
    }
}
