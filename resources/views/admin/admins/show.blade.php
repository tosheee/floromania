@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <a href="/admin/admins" class="btn btn-default">Обратно</a>

        <h1>{{ $admin->name }}</h1>

        <div class="well">

            <a href="/admin/admins/{{ $admin->id }}/edit" class="btn btn-default"> Промяна </a>

            <form method="POST" action="/admin/admin/{{ $admin->id }}" accept-charset="UTF-8" class="pull-right">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="DELETE">
                <input class="btn btn-danger" type="submit" value="Delete">
            </form>

        </div>
    @include('admin.admin_partials.admin_menu_bottom')
@endsection