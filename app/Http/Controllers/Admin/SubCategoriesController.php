<?php

namespace App\Http\Controllers\Admin;

use App\Admin\SubCategory;
use App\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('admin.sub_categories.index')->with('categories', $categories)->with('subCategories', $subCategories)->with('title', 'Всички подкатегории');
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.sub_categories.create')->with('categories', $categories)->with('title', 'Създаване на подкатегория');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name'        => 'required',
            'identifier'  => 'required',
        ]);

        $subCategory = new SubCategory;
        $subCategory->category_id = $request->input('category_id');
        $subCategory->name        = $request->input('name');
        $subCategory->identifier  = $request->input('identifier');
        $subCategory->save();

        return redirect('admin/sub_categories')->with('success', 'Подкатегорията е създадена');
    }

    public function show($id)
    {
        $categories = Category::all();
        $subCategory = SubCategory::find($id);

        return view('admin.sub_categories.show')->with('categories', $categories)->with('subCategory', $subCategory)->with('title', 'Преглед на подкатегория');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $subCategory = SubCategory::find($id);

        return view('admin.sub_categories.edit')->with('categories', $categories)->with('subCategory', $subCategory)->with('title', 'Обновяване на подкатегория');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
            'identifier' => 'required',
        ]);

        $subCategory = SubCategory::find($id);

        $subCategory->category_id = $request->input('category_id');
        $subCategory->name        = $request->input('name');
        $subCategory->identifier  = $request->input('identifier');
        $subCategory->save();

        return redirect('/admin/sub_categories')->with('success', 'Подкатегорията е обновена');
    }

    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();

        return redirect('/admin/sub_categories')->with('success', 'Подкатегорията е изтрита');
    }
}
