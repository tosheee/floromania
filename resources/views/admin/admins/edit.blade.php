@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <a href="/admin/admins" class="btn btn-default">Обратно</a>
        <br>
        <br>
        <form method="POST" action="/admin/admins/{{ $admin->id }}" accept-charset="UTF-8" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Име</label>
                <input class="form-control" placeholder="Name" name="name" type="text" value="{{ $admin->name }}" id="name">
            </div>

            <div class="form-group">
                <label for="name">Имейл</label>
                <input class="form-control" placeholder="Email" name="email" type="text" value="{{ $admin->email }}" id="email">
            </div>

            <div class="form-group">
                <label for="name">Парола</label>
                <input class="form-control" placeholder="Password" name="password" type="text" value="{{ $admin->password }}" id="password">
            </div>

            <input name="_method" type="hidden" value="PUT">
            <input class="btn btn-primary" type="submit" value="Промяна">
        </form>

    @include('admin.admin_partials.admin_menu_bottom')
@endsection