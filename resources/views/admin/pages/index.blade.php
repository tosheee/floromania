@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')
        <h3>Страници</h3>
        <a class="btn btn-primary" href="/admin/pages/create">Създаване на страници</a>
        <br>
        <br>
        @if(count($pages) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Име на страницата</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($pages as $page)
                    <tr>
                        <td><a href="/admin/pages/{{ $page->id }}">{{ $page->name_page }}</a></td>
                        <td><a class="btn btn-default" href="/admin/pages/{{ $page->id }}/edit">Промяна</a></td>
                        <td>
                            <form method="POST" action="/admin/pages/{{ $page->id }}" accept-charset="UTF-8" class="pull-right">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <input class="btn btn-danger" type="submit" value="Изтрий">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>Няма създадени страници</p>
        @endif
    @include('admin.admin_partials.admin_menu_bottom')
@endsection