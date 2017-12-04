<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index')->with('categories', $categories)->with('title', 'Всички категории');
    }


    public function create()
    {
        return view('admin.categories.create')->with('title', 'Нова категория');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = new Category;
        $category->name = $request->input('name');
        $category->save();

        return redirect('admin/categories')->with('title', 'Нова категория')->with('message', 'Категорията е създадена');
    }

    public function show($id)
    {
        $category = Category::find($id);

        return view('admin.categories.show')->with('category', $category)->with('title', 'Преглед на категория' );
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit')->with('category', $category)->with('title', 'Промяна на категория');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();

        return redirect('/admin/categories')->with('message', 'Категорията е променена');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('/admin/categories')->with('message', 'Категорията е изтрита');
    }
}
