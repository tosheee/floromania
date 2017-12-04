@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <a class="btn btn-primary" href="/admin/admins/create">Нов Администратор</a>
        <br>
        <br>
        @if(count($admins) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Име</th>
                    <th>Имейл</th>
                    <th>Парола</th>
                    <th>Промяна</th>
                    <th>Изтриване</th>
                </tr>
                @foreach($admins as $admin)
                    <tr>
                        <td><a href="/admin/admins/{{ $admin->id }}">{{ $admin->name }}</a></td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->password }}</td>
                        <td><a class="btn btn-default" href="/admin/admins/{{ $admin->id }}/edit">Промяна</a></td>
                        <td>
                            <form method="POST" action="/admin/admins/{{ $admin->id }}" accept-charset="UTF-8" class="pull-right">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <input class="btn btn-danger" type="submit" value="Изтриване">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>Няма администратори</p>
        @endif

    @include('admin.admin_partials.admin_menu_bottom')
@endsection