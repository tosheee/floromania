@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')
        <h3>Подкатегория</h3>
        <a class="btn btn-primary" href="/admin/sub_categories/create">Нова подкатегория</a>
        <br><br>
        @if(count($subCategories) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Категория</th>
                    <th>Подкатегоря</th>
                    <th>Идентификатор</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($subCategories as $subCategory)
                    <tr>
                        @foreach($categories as $category)
                            @if($subCategory->category_id == $category->id)
                                <td>{{ $category->name }} </td>
                            @endif
                        @endforeach
                        <td><a href="/admin/sub_categories/{{ $subCategory->id }}">{{ $subCategory->name }}</a></td>
                        <td>{{ $subCategory->identifier }}</td>
                        <td><a class="btn btn-default" href="/admin/sub_categories/{{ $subCategory->id }}/edit">Промяна</a></td>
                        <td>
                            <form method="POST" action="/admin/sub_categories/{{ $subCategory->id }}" accept-charset="UTF-8" class="pull-right">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <input class="btn btn-danger" type="submit" value="Изтрий">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>Няма подкатегории</p>
        @endif
    @include('admin.admin_partials.admin_menu_bottom')
@endsection