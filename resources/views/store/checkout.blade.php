@extends('layouts.app')

@section('content')

    <div class="col-md-2">
        @include('partials.v_nav_bar')
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <div class="contentCheckout">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-10 col-md-6">
                                <div class="checkout-items">
                                    <div class="list-checkout">
                                        <ul class="steps-checkout">
                                            <li class="steps active-check"><a href="#"> <span class="fa fa-truck"></span> Поръчка</a></li>
                                            <li class="steps"><a href="#"> <span class="fa fa-credit-card"></span> Плащане</a></li>
                                            <li class="steps"><a href="#"> <span class="fa fa-check"></span> Потвъждаване</a></li>
                                        </ul>
                                    </div>

                                    <div class="contentShipping">
                                        <form id="form-shipping" class="" name="form-shipping" action="/checkout" method="post">
                                            {{ csrf_field() }}
                                            <fieldset>
                                                <input name="user_id" class="form-control chkndo-input" placeholder="Име" type="hidden" value="{{ isset(Auth::user()->id) ? Auth::user()->id : '' }}">

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6">
                                                            <label class="control-label" for="name">Име:</label>
                                                            <input name="name" class="form-control chkndo-input" placeholder="Име" type="text" value="{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}">
                                                        </div>

                                                        <div class="col-sm-12 col-md-6">
                                                            <label class="control-label" for="last_name">Фамилия:</label>
                                                            <input name="last_name" class="form-control chkndo-input" placeholder="Фамилия" type="text">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12 col-md-6">
                                                            <label class="control-label" for="email">е-адрес:</label>
                                                            <input name="email" class="form-control chkndo-input" placeholder="е-адрес" type="text" value="{{ isset(Auth::user()->email) ? Auth::user()->email : '' }}">
                                                        </div>

                                                        <div class="col-md-12 col-md-6">
                                                            <label class="control-label" for="surname">Телефон:</label>
                                                            <input name="phone" class="form-control chkndo-input" placeholder="Телефон" type="text">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="control-label" for="district">Адрес</label>
                                                            <textarea name="address" id="" cols="30" rows="5" class="form-control chkndo-input"></textarea>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input name="delivery_method" class="" type="radio" value="Доставка до адрес" checked>
                                                            <label class="control-label" for="delivery_method">Доставка до адрес</label>

                                                            <input name="delivery_method" class="" type="radio" value="Доставка до офис на куриер">
                                                            <label class="control-label" for="delivery_method">Доставка до офис на куриер</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input name="payment_method" class="" type="radio" value="Наложен платеж" checked>
                                                            <label class="control-label" for="payment_method" >Наложен платеж</label>

                                                            <input name="payment_method" class="" type="radio" value="С карта">
                                                            <label class="control-label" for="payment_method">С карта</label>

                                                            <input name="payment_method" class="" type="radio" value="С банков превод">
                                                            <label class="control-label" for="payment_method">С банков превод</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="control-label" for="district">Бележка:</label>
                                                            <textarea name="note" id="" cols="30" rows="5" class="form-control chkndo-input"></textarea>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="control-label" for="district">Фирма:</label>
                                                            <input name="district" class="form-control chkndo-input" placeholder="Фирма" type="text">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="control-label" for="district">ЕИК или ДДС No:</label>
                                                            <input name="district" class="form-control chkndo-input" placeholder="ЕИК или ДДС No" type="text">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-success">Потвърди</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-10 col-md-6">
                                <div class="cartForCheckout" style="width: 70%">
                                    <h2>Твоята количка</h2>
                                    <div class="contenCart">

                                        <div class="products-forCheckout">
                                            <ul class="ul-forCheckoutItems">

                                                @foreach($cart->items as $item)
                                                    <?php $description = json_decode($item['item']->description, true); ?>


                                                    <div class="divider"></div>
                                                    <li class="countCheckout">
                                                        <h4><a href="/store/{{ $item['item']->id }}" target="_blank">{{ $description['title_product'] }}</a></h4>
                                                        <p>{{ $item['qty'] }} <strong> x </strong> </p>
                                                        <p> {{ $description['price'] }} {{ $description['currency'] }}</p>
                                                    </li>


                                                @endforeach


                                                <div class="divider"></div>
                                                <li class="countCheckout">
                                                    <p class="objetc">Доставка</p>
                                                    <p class="price">0.00</p>
                                                </li>

                                                <li class="countCheckout">
                                                    <p class="objetc"></p>
                                                    <p class="price"></p>
                                                </li>


                                                <div class="divider"></div>
                                                <li class="countCheckout">
                                                    <p class="objetc totalPrice">Total</p>
                                                    <p class="price totalPrice">{{ $cart->totalPrice }} лв.</p>
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
        </div>
    </div>

@endsection