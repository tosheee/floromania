@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')
        <a href="/admin/categories" class="btn btn-default">Обратно</a>
        <br>
        <br>
        <div class="well">
            <strong>{{ $subCategory->category_id }}</strong> <strong>{{ $subCategory->name }}</strong> <strong>{{ $subCategory->identifier }}</strong>
            <a href="/admin/sub_categories/{{ $subCategory->id }}/edit" class="btn btn-default">Промяна</a>
            <form method="POST" action="/admin/sub_categories/{{ $subCategory->id }}" accept-charset="UTF-8" class="pull-right">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="DELETE">
                <input class="btn btn-danger" type="submit" value="Изтрий">
            </form>
        </div>
    @include('admin.admin_partials.admin_menu_bottom')
@endsection