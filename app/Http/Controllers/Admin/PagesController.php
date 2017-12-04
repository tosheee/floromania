<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Page;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $pages = Page::all();

        return view('admin.pages.index')->with('pages', $pages)->with('title', 'Всички страниц');
    }

    public function create()
    {
        $pages = Page::all();

        return view('admin.pages.create')->with('pages', $pages)->with('title', 'Създаване на страница');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_page' => 'required',
            'url_page'        => 'required',
            'content'  => 'required',
        ]);

        $page = new Page;
        $page->name_page   = $request->input('name_page');
        $page->url_page    = $request->input('url_page');
        $page->content     = $request->input('content');
        $page->active_page = $request->input('active_page');
        $page->save();

        return redirect('admin/pages')->with('success', 'Страницата е създадена');
    }

    public function show($id)
    {
        $page = Page::find($id);

        return view('admin.pages.show')->with('page', $page)->with('title', 'Преглед на страница');
    }

    public function edit($id)
    {
        $page = Page::find($id);

        return view('admin.pages.edit')->with('page', $page)->with('title', 'Промяна на страница');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name_page' => 'required',
            'url_page'  => 'required',
            'content'   => 'required',
        ]);

        $page = Page::find($id);
        $page->active_page = $request->input('active_page');
        $page->name_page   = $request->input('name_page');
        $page->url_page    = $request->input('url_page');
        $page->content     = $request->input('content');
        $page->save();

        return redirect('admin/pages')->with('success', 'Страницата е обновена');
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();

        return redirect('/admin/pages')->with('success', 'Страницата е изтрита');
    }
}
