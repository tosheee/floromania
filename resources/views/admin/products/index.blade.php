@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')
        <a class="btn btn-primary" href="/admin/products/create">Нов продукт</a>
        <br/><br/>
        @if(count($products) > 0)
            <table class="table table-striped">
                <tr>
                    <th>Системни</th>
                    <th>Статус на продукта</th>
                    <th>Име на продукта</th>
                    <th>Изображение</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($products as $product)
                    <tr>
                        <td style="width:30%">
                        @foreach($categories as $category)
                            @if($product->category_id == $category->id)
                                <p><b>Категория:</b> {{ $category->name }}</p>
                            @endif
                        @endforeach

                        @foreach($subCategories as $subCategory)
                            @if($product->sub_category_id == $subCategory->id)
                                <p><b>Подкатегория:</b> {{ $subCategory->name }}</p>
                            @endif
                        @endforeach

                            <p><b>Идентификатор:</b> {{ $product->identifier }} </p>
                        </td>


                        <td style="width:20%">
                            <p><b>Активен: </b>{{ $product->active == 1 ? 'ДА' : 'НЕ' }}</p>
                            <p><b>Разпродажба: </b>{{ $product->sale == 1 ? 'ДА' : 'НЕ' }}</p>
                            <p><b>Препоръчан: </b>{{ $product->recommended == 1 ? 'ДА' : 'НЕ' }}</p>
                            <p><b>Най-продаван: </b>{{ $product->best_sellers == 1 ? 'ДА' : 'НЕ' }}</p>
                        </td>

                        <td>
                            <?php $descriptions = json_decode($product->description, true); ?>
                            @if(isset($descriptions['article_id']))
                                {{ $descriptions['article_id'] }}
                            @endif
                            @if(isset($descriptions['title_product']))
                                <a href="/admin/products/{{ $product->id }}">{{ $descriptions['title_product'] }}</a>
                            @endif
                        </td>
                        <td>
                            <div class="middle">
                                @if (isset($descriptions['main_picture_url']))
                                    <img style="margin: 0 auto; width: 120px;height: 100px;" src="{{ $descriptions['main_picture_url'] }}" alt="pic" />
                                @elseif(isset($descriptions['upload_main_picture']))
                                    <img style="margin: 0 auto; width: 120px;height: 100px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptions['upload_main_picture'] }}" alt="pic" />
                                @else
                                    <img style="margin: 0 auto; width: 120px;height: 100px;" src="/storage/upload_picture/noimage.jpg" alt="pic" />
                                @endif
                            </div>
                        </td>

                        <td>
                            <a class="btn btn-default" href="/admin/products/{{ $product->id }}/edit">Промяна</a>
                        </td>

                        <td>
                            <form method="POST" action="/admin/products/{{ $product->id }}" accept-charset="UTF-8" class="pull-right">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <input class="btn btn-danger" type="submit" value="Изтриване">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $products->links() }}
        @else
            <p>Няма намерени продукти</p>
        @endif
    @include('admin.admin_partials.admin_menu_bottom')
@endsection