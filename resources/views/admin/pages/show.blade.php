@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')
        <a href="/admin/pages" class="btn btn-default">Обратно</a>
        <a href="/admin/pages/{{ $page->id }}/edit" class="btn btn-default">Промяна</a>
        <form method="POST" action="/admin/pages/{{ $page->id }}" accept-charset="UTF-8" class="pull-right">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
            <input class="btn btn-danger" type="submit" value="Изтрий">
        </form>
        <h3>{{ $page->name_page }}   {{ $page->url_page }}</h3>
        {!! $page->content !!}
    @include('admin.admin_partials.admin_menu_bottom')
@endsection