@extends('layouts.app')

@section('content')
    <div class="col-md-2"> @include('partials.v_nav_bar') </div>

    <div class="col-md-9">
        <div class="row">


            @if(count($user_orders) > 0)
                @foreach($user_orders as $order)
                    <table class="table table-striped">
                        <tr>
                            <th >Order id</th>
                            <th>Name Client</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Payment method</th>
                            <th>Delivery method</th>
                            <th>Note</th>
                            <th>Company</th>
                            <th>Bulstat</th>
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
                                <td>{{ $order->company }}</td>
                                <td>{{ $order->bulstat }}</td>
                            </tr>

                            <tr>
                                <table class="table table-striped">
                                    @if($order->completed_order == 1)
                                        <tr style="background-color:#e3efd2">
                                    @else
                                        <tr>
                                            @endif
                                            <th>Total Quantity</th>
                                            <th>Total Price</th>
                                            <th>Products</th>
                                            <th>Price</th>
                                        </tr>
                                        <?php $products = unserialize(base64_decode($order->cart)) ?>
                                        @foreach($products->items as $product)
                                            <?php $descriptions = json_decode($product['item']['description'], true); ?>
                                            @if($order->completed_order == 1)
                                                <tr style="background-color:#e3efd2">
                                            @else
                                                <tr>
                                                    @endif
                                                    <td>{{ $product['qty'] }} units</td>
                                                    <td>{{ $product['total_item_price'] }} лв.</td>
                                                    <td><a href="/admin/products/{{ $product['item']['id'] }}">{{ $descriptions['title_product'] }}</a></td>
                                                    <td>{{ $descriptions['price']}} лв.</td>
                                                </tr>
                                                @endforeach
                                </table>
                            </tr>

                            <tr>
                                Total Quantity: <strong>{{ $products->totalQty}} units</strong>
                                Total Price: <strong>{{ $products->totalPrice }} лв.</strong>
                                Completed Order: <strong class="completed-order">{{ $order->completed_order }} </strong>
                            </tr>
                            <script>
                                $(document).ready(function(){
                                    $('.completed-order').html();

                                });

                            </script>


                    </table>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                @endforeach

                {{ $user_orders->links() }}

            @else
                <p>No Orders</p>
            @endif





        </div>
    </div>
@endsection