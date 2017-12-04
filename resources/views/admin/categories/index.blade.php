@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <a class="btn btn-primary" href="/admin/categories/create">Нова категория</a>
        <br>
        <br>
        @if(count($categories) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Име на категорията</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($categories as $category)
                    <tr>
                        <td><a href="/admin/categories/{{ $category->id }}">{{ $category->name }}</a></td>
                        <td><a class="btn btn-default" href="/admin/categories/{{ $category->id }}/edit">Промяна</a></td>
                        <td>
                            <form method="POST" action="/admin/categories/{{ $category->id }}" accept-charset="UTF-8" class="pull-right">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <input class="btn btn-danger" type="submit" value="Изтриване">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>Няма създадени категегории</p>
        @endif
    @include('admin.admin_partials.admin_menu_bottom')
@endsection