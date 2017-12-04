@extends('layouts.app')

@section('content')
    <div class="col-md-2"> @include('partials.v_nav_bar') </div>

    <?php $descriptions = json_decode($product->description, true); ?>

    <a href="/store" class="btn btn-default">Обратно в магазина</a>

    <br>
    <br>

    <ul>
        <li>
            @foreach($categories as $category)
                @if($product->category_id == $category->id)
                  >  {{ $category->name }}
                @endif
            @endforeach
            >
            @foreach($subCategories as $subCategory)
                @if($product->sub_category_id == $subCategory->id)
                    {{ $subCategory->name }}
                @endif
            @endforeach
        </li>
    <ul>

    <hr>
        <div class="col-xs-4 item-photo">
            <div class="container-fluid">
                <div id="custom_carousel" class="carousel slide" data-ride="carousel" data-interval="4000">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="container-fluid">
                                <div class="row" >
                                    @if (isset($descriptions['main_picture_url']))
                                        <img src="{{ $descriptions['main_picture_url'] }}" alt="pic" />
                                    @elseif(isset($descriptions['upload_main_picture']))
                                        <img src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptions['upload_main_picture'] }}" alt="pic" />
                                    @else
                                        <img src="/storage/common_pictures/noimage.jpg" alt="pic" />
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if (isset($descriptions['gallery']))
                            @foreach( $descriptions['gallery'] as $key => $type_pictures)
                                @foreach($type_pictures as $key_picture => $picture)
                                    @if($key == 1)
                                        <div class="item">
                                            <div class="container-fluid">
                                                <div class="row" >
                                                    @if($key_picture == 'upload_picture')
                                                        <img src="/storage/upload_pictures/{{ $product->id }}/{{ $type_pictures[$key_picture] }}" class="img-responsive">
                                                    @else
                                                        <img src="{{ $type_pictures[$key_picture] }}" class="img-responsive">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="item">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    @if($key_picture == 'upload_picture')
                                                        <img src="/storage/upload_pictures/{{ $product->id }}/{{ $type_pictures[$key_picture] }}" class="img-responsive">
                                                    @else
                                                        <img src="{{ $type_pictures[$key_picture] }}" class="img-responsive">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </div>

                    @if (isset($descriptions['gallery']))
                        <div class="controls draggable ui-widget-content col-md-6 col-xs-12" style="width: 350px;height: 50px;">
                            <ul class="nav ui-widget-header" >

                                <li data-target="#custom_carousel" data-slide-to="{{ $index = 0 }}" class="active">

                                    @if (isset($descriptions['main_picture_url']))
                                        <a href="#"><img style="margin: 0 auto; width: 35px; height: 30px;" src="{{ $descriptions['main_picture_url'] }}" alt="pic" /></a>
                                    @elseif(isset($descriptions['upload_main_picture']))
                                        <a href="#"><img style="margin: 0 auto; width: 35px; height: 30px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $descriptions['upload_main_picture'] }}" alt="pic" /></a>
                                    @else
                                        <a href="#"><img style="margin: 0 auto; width: 35px; height: 30px;" src="/storage/common_pictures/noimage.jpg" alt="pic" /></a>
                                    @endif

                                </li>

                                <?php $index = 1; ?>
                                @foreach( $descriptions['gallery'] as $type_pictures)
                                    @foreach($type_pictures as $key_picture => $picture)
                                        @if($index == 1)
                                            <li data-target="#custom_carousel" data-slide-to="{{ $index }}" class="active">
                                                @if($key_picture == 'upload_picture')
                                                    <a href="#"><img style="margin: 0 auto; width: 35px; height: 30px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $type_pictures[$key_picture] }}"></a>
                                                @else
                                                    <a href="#"><img style="margin: 0 auto; width: 35px; height: 30px;" src="{{ $type_pictures[$key_picture] }}"></a>
                                                @endif
                                            </li>
                                            <?php $index ++;?>
                                        @else
                                            <li data-target="#custom_carousel" data-slide-to="{{ $index }}" >
                                                @if($key_picture == 'upload_picture')
                                                    <a href="#"><img style="margin: 0 auto; width: 35px; height: 30px;" src="/storage/upload_pictures/{{ $product->id }}/{{ $type_pictures[$key_picture] }}"></a>
                                                @else
                                                    <a href="#"><img style="margin: 0 auto; width: 35px; height: 30px;" src="{{ $type_pictures[$key_picture] }}"></a>
                                                @endif
                                            </li>
                                            <?php $index++;?>
                                        @endif
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>

                    @endif
                </div>
                    <!-- End Carousel -->
                </div>
            </div>

            <div class="col-xs-5" style="border:0px solid gray">


                <h1>{{ $product['qty'] }}</h1>

                <h2>{{ $descriptions['title_product'] }}</h2>
                <small style="color:#337ab7"></small>

                <p style="color:rgba(8, 9, 21, 0.96)"> {{ isset($descriptions['short_description']) ? $descriptions['short_description'] : '' }} </p>

                <!-- Precios -->
                <h6 class="title-price"><small></small></h6>
                <h3 style="margin-top: 0px;">Цена: {{ $descriptions['price'] }} {{ $descriptions['currency'] }}
                @if (isset($descriptions['old_price']))
                    <span class="old-price">   {{ $descriptions['old_price'] }} {{ $descriptions['currency'] }}</span>
                @endif
                </h3>
                <!-- Detalles especificos del producto -->

                <div class="section" style="margin-left: 2px;">
                    <div class="section" style="padding-bottom:10px;">
                        <div class="paragraph borderBlock USPs">
                            <div class="row" style="padding-left:10px;">
                                <div class="grid-5">
                                    <span  class="kor-open-as-dialog ish-tooltip" data-overlay-class="ish-dialogPage" alt="70 години опит" title="70 години опит">
                                        <i class="fa fa-check"></i> <label>Внимателно опаковано</label>
                                    </span>
                                </div>
                                <div class="grid-6">
                                    <span class="kor-open-as-dialog ish-tooltip" data-overlay-class="ish-dialogPage" alt="свежи продукти" title="свежи продукти">
                                        <i class="fa fa-check"></i>
                                        <label>Свежи продукти</label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section" style="padding-bottom:10px;">
                        <!-- product count -->
                        <div class="price clearfix">
                            <div class="product-count">
                                <?php
                                if(Session::has('cart'))
                                {
                                    $oldCart = Session::get('cart');
                                    if(isset($oldCart->items[$product->id]['qty']))
                                    {
                                    $product_qty = $oldCart->items[$product->id]['qty'];
                                    }

                                }
                                ?>


                                <input type="text" class="count-textbox" value="{{ isset($product_qty) ? $product_qty : '1' }}" id="quantity-product" readonly>


                                <button class="minus-button"><i class="fa fa-chevron-down" aria-hidden="true"></i></button>
                                <button class="plus-button"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
                                <input id="id-product" type="hidden" name="q" value="{{ $product->id }}"/>
                            </div>
                        </div>
                    </div>

                    <div class="section" >
                        <p>Продуктов код: {{ isset($descriptions['article_id'])  ? $descriptions['article_id'] : '' }}</p>
                    </div>

                    <div class="section" >
                        <p>Статус: {{ isset($descriptions['product_status'])  ? $descriptions['product_status'] : '' }}</p>
                    </div>

                    <div class="section" style="padding: 50px 30px 30px 40px;">
                        @if ($descriptions['product_status'] == 'Не е наличен')
                            <a  style="background-color: #FF9900; border-color: #FF9900;" class="btn btn-success" href="#">{{ $descriptions['product_status'] }}</a>
                        @else
                            <a class="add-product-button btn btn-success" >Добави в количката</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xs-9">
                <ul class="menu-items">
                    <li class="active">Информация за продукта</li>
                    <li></li>
                    <li></li>
                </ul>

                <div style="width:100%;border-top:1px solid silver">
                    <p style="padding:15px;">
                        <p style="font-size: 150%;"> {!! $descriptions['general_description'] !!} </p>
                    </p>
                    <small>
                        <ul>
                            @if(isset($descriptions['properties']))
                                @foreach( $descriptions['properties'] as $key => $property)
                                    <li>
                                        @if ($key % 2 == 0)
                                            {{ $property['name'] }} :
                                        @else
                                            {{ $property['text'] }}
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </small>
                </div>
            </div>

        <script>
            $(document).ready(function() {
                $(".plus-button").on('click', function() {
                    var plusValue = parseInt($('#quantity-product').val());
                    if (!isNaN(plusValue)) {
                        $('#quantity-product').val(plusValue + 1);
                    } else {
                        $('#quantity-productt').val(1);
                    }
                });

                $(".minus-button").on('click', function() {
                    var minusValue = parseInt($('#quantity-product').val());
                    if (!isNaN(minusValue) && minusValue > 1) {
                        $('#quantity-product').val(minusValue - 1);
                    } else {
                        $('#quantity-product').val(1);
                    }
                });
            });
        </script>

        <script>
                /*
                //slider
                $(document).ready(function(ev){
                    var items = $(".nav li").length;
                    var leftRight=0;
                    if(items>5){
                        leftRight=(items-5)*50*-1;
                    }
                    $('#custom_carousel').on('slide.bs.carousel', function (evt) {
                        $('#custom_carousel .controls li.active').removeClass('active');
                        $('#custom_carousel .controls li:eq('+$(evt.relatedTarget).index()+')').addClass('active');
                    })
                    $('.nav').draggable({
                        axis: "x",
                        stop: function() {
                            var ml = parseInt($(this).css('left'));
                            if(ml>0)
                                $(this).animate({left:"0px"});
                            if(ml<leftRight)
                                $(this).animate({left:leftRight+"px"});
                        }
                    });
                });

                $(document).ready(function(){
                    //-- Click on detail
                    $("ul.menu-items > li").on("click",function(){
                        $("ul.menu-items > li").removeClass("active");
                        $(this).addClass("active");
                    })
                    $(".attr,.attr2").on("click",function(){
                        var clase = $(this).attr("class");
                        $("." + clase).removeClass("active");
                        $(this).addClass("active");
                    })
                    //-- Click on QUANTITY
                    $(".btn-minus").on("click",function(){
                        var now = $(".section > div > input").val();
                        if ($.isNumeric(now)){
                            if (parseInt(now) -1 > 0){ now--;}
                            $(".section > div > input").val(now);
                        }else{
                            $(".section > div > input").val("1");
                        }
                    })
                    $(".btn-plus").on("click",function(){
                        var now = $(".section > div > input").val();
                        if ($.isNumeric(now)){
                            $(".section > div > input").val(parseInt(now)+1);
                        }else{
                            $(".section > div > input").val("1");
                        }
                    })
                })*/
            </script>

@endsection
