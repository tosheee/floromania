@extends('layouts.app')

@section('content')
    <div class="col-md-2"> @include('partials.v_nav_bar') </div>
    <script>
        $('#new-view-cart').hide();
        $('#menu-scroll-cart').hide();
    </script>

    <div class="container">
        <div class="row" >
            @if(Session::has('cart'))
                <div class="col-sm-10">
                    <table id="table-shopping-cart" class="table table-hover">

                        <thead>
                            <tr>
                                <th>Продукт</th>

                                <th class="text-center"></th>
                                <th></th>
                                <th class="text-center"></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($products as $product)
                                <?php $descriptions = json_decode($product['item']->description, true); ?>
                                <tr>
                                    <td class="col-sm-8 col-md-8">
                                        <div class="media">

                                            @if (isset($descriptions['main_picture_url']))
                                                <a class="thumbnail pull-left" href="/store/{{ $product['item']->id}}"> <img  style="margin: 0 auto; width: 150px;height: 150px;" src="{{ $descriptions['main_picture_url'] }}" alt="pic" /></a>
                                            @elseif(isset($descriptions['upload_main_picture']))
                                                <a class="thumbnail pull-left" href="/store/{{ $product['item']->id }}">  <img  style="margin: 0 auto; width: 150px;height: 100px;" src="/storage/upload_pictures/{{ $product['item']->id }}/{{ $descriptions['upload_main_picture'] }}" alt="pic" /></a>
                                            @else
                                                <a class="thumbnail pull-left" href="/store/{{ $product['item']->id }}">  <img style="margin: 0 auto; width: 150px;height: 100px;" src="/storage/common_pictures/noimage.jpg" alt="pic" /></a>
                                            @endif

                                            @if(isset($descriptions['price']))
                                                <div class="media-body" >
                                                    <h4 class="media-heading" style="padding-left: 10px;"><a href="/store/{{ $product['item']->id }}" target="_blank">{{ $descriptions['title_product'] }}</a></h4>
                                                    <h5 class="media-heading"><a href="#"></a></h5>
                                                    <span  style="padding-left: 10px;">Статус: </span><span class="text-success"><strong>{{ $descriptions['product_status'] }}</strong></span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    @if(isset($descriptions['price']))
                                        <td id="cell-product-count" align="center">
                                            <div>
                                                <div class="price clearfix">

                                                    <div class="product-count">
                                                        <input type="text" class="count-textbox" value="{{ $product['qty'] }}" id="quantity-product" readonly>
                                                        <button class="minus-button"><i class="fa fa-chevron-down" aria-hidden="true"></i></button>
                                                        <button class="plus-button"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
                                                        <input id="id-product" type="hidden" name="q" value=""/>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="col-sm-1 col-md-1 text-center">
                                            <strong>{{ $descriptions['price'] }} {{ $descriptions['currency'] }}</strong>
                                        </td>

                                        <td class="col-sm-1 col-md-1 text-center">
                                            <strong id="total-item-price">
                                                {{ $product['qty'] * $descriptions['price'] }} {{ $descriptions['currency'] }}
                                            </strong>
                                        </td>
                                    @endif

                                    <td id="button-wrapper-sc" align="center">
                                        <button id="button-update-quantity" class="add-product-button" style="width:40%; background-color: #5def8a; border-color:#5def8a; " title="Обнови количеството">
                                            <i class="fa fa-check" aria-hidden="true" style="color: #ffffff"></i>
                                            <input id="id-product" type="hidden" name="q" value="{{ $product['item']['id'] }}"/>
                                        </button>

                                        <button type="button" class="remove-item-button" style="width:40%; background-color: #ff4208; border-color:#ff4208; " title="Премахване на продукт">
                                            <i class="fa fa-close" style="color: #ffffff"></i>
                                            <input id="id-product" type="hidden" value="{{ $product['item']->id }}"/>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr/>


                    <div style="margin-left: 45%" class="col-sm-8">
                        <div class="cartForCheckout" style="width: 70%">
                            <div class="contenCart">
                                <div class="products-forCheckout">
                                    <ul class="ul-forCheckoutItems">
                                        <div class="divider"></div>
                                        <li class="countCheckout">
                                            <p class="objetc totalPrice">Общо: </p>
                                            <p class="price totalPrice">
                                                @if(isset($descriptions['currency']))
                                                    <strong>{{ $totalPrice }} {{ $descriptions['currency'] }}</strong>
                                                @endif
                                            </p>
                                        </li>
                                        <div class="divider"></div>
                                        <li class="countCheckout">
                                            <div class="btn-group btn-group-justified">
                                                <a href="/store" class="btn btn-default">Пазарувай</a>
                                                <a href="/checkout" class="btn btn-primary">Продължи поръчката</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".plus-button").on('click', function() {
                var current_row = $(this).parent().parent().parent().parent().parent();
                var quantity_product = current_row.find('#quantity-product');
                var plusValue = parseInt(quantity_product.val());

                if(current_row.find('#button-update-quantity').length < 1)
                {
                    current_row.find('#button-wrapper-sc').append(button_update_qty);
                }

                if (!isNaN(plusValue)) {
                    quantity_product.val(plusValue + 1);
                } else {
                    quantity_product.val(1);
                }
            });

            $(".minus-button").on('click', function() {
                var current_row = $(this).parent().parent().parent().parent().parent();
                var quantity_product = current_row.find('#quantity-product');
                var minusValue = parseInt(quantity_product.val());

                if(current_row.find('#button-update-quantity').length < 1)
                {
                    current_row.find('#button-wrapper-sc').append(button_update_qty);
                }

                if (!isNaN(minusValue) && minusValue > 1) {
                    quantity_product.val(minusValue - 1);
                } else {
                    quantity_product.val(1);
                }
            });
        });
    </script>

    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <script>
                    window.location.href = '/';
                </script>
            </div>
        </div>
    @endif

@endsection