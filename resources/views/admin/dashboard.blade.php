@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')
    <br>
    <br>
    @if(count($orders) > 0)
        @foreach($orders as $order)
            <table class="table table-striped">
                <tr style="color: #ffffff; background-color: #084951">
                    <th >ID</th>
                    <th>Име на клиент</th>
                    <th>Телефон</th>
                    <th>Имеил</th>
                    <th>Адрес</th>
                    <th>Метод на плащане</th>
                    <th>Метод за получаване</th>
                    <th>Бележка</th>
                    @if(!empty($order->company))
                        <th>Фирма</th>
                    @endif
                    @if(!empty($order->bulstat))
                        <th>Булстат</th>
                    @endif
                </tr>

                @if($order->completed_order == 1)
                    <tr style="background-color:#e3efd2">
                @else
                    <tr>
                @endif
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name}} {{ $order->last_name}}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->delivery_method }}</td>
                    <td>{{ $order->note }}</td>
                    @if(!empty($order->company))
                        <td>{{ $order->company }}</td>
                    @endif

                    @if(!empty($order->company))
                        <td>{{ $order->bulstat }}</td>
                    @endif
                </tr>

                <tr>
                      <table class="table table-striped">
                          @if($order->completed_order == 1)
                              <tr style="background-color:#e3efd2">
                          @else
                              <tr>
                          @endif
                              <th>Общо количество </th>
                              <th>Обща цена </th>
                              <th>Име на продукта</th>
                              <th>Единична цена</th>
                          </tr>
                          <?php $products = unserialize(base64_decode($order->cart)) ?>
                          @foreach($products->items as $product)
                              <?php $descriptions = json_decode($product['item']['description'], true); ?>
                              @if($order->completed_order == 1)
                                  <tr style="background-color:#e3efd2">
                              @else
                                  <tr>
                              @endif
                                      <td>{{ $product['qty'] }} бр.</td>
                                      <td>{{ $product['total_item_price'] }} лв.</td>
                                      <td><a href="/admin/products/{{ $product['item']['id'] }}">{{ $descriptions['title_product'] }}</a></td>
                                      <td>{{ $descriptions['price']}} лв.</td>
                                  </tr>
                          @endforeach
                      </table>
                </tr>

                <tr>
                    | Общ брой на продуктите в поръчката: <strong style="font-size: 130%">{{ $products->totalQty}} бр.</strong>
                    | Общо за изплащане: <strong style="font-size: 130%" >{{ $products->totalPrice }} лв.</strong> |
                </tr>
                <script>
                   $(document).ready(function(){
                       $('.completed-order').html();

                    });

                </script>

                <div>
                    <a class="btn btn-info" href="/admin/dashboard/{{ $order->id }}">Преглед на поръчката</a>

                    @if($order->completed_order == 1)
                        <a class="btn btn-warning" href="/admin/completed_order/{{ $order->id }}">Размаркирай като изпълнена</a>
                    @else
                        <a class="btn btn-primary" href="/admin/completed_order/{{ $order->id }}">Маркирай като изпълнена</a>
                    @endif

                    <form method="POST" action="/admin/dashboard/{{ $order->id }}" accept-charset="UTF-8" class="pull-right">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <input class="btn btn-danger" type="submit" value="Изтриване на поръчката">
                    </form>
                </div>
            </table>
            <br/>
            <br/>
            <br/>
            <br/>
            @endforeach

        {{ $orders->links() }}

    @else
        <p>No Orders</p>
    @endif

    @include('admin.admin_partials.admin_menu_bottom')
@endsection