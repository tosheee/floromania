<script>
    $('.product_buttons').on('click', '.button-like', function() {
        var idProduct = $(this).parent().find('input#id-product').val()

        $.ajax({
            method: "post",
            url: "/store/like_product/" + idProduct,
            data: { "_token": "{{ csrf_token() }}" },
            success: function( new_cart ) {
                $('.header-item.mr-5').find('sub').html(new_cart);
            }
        });
    });
</script>






<script>
    $('ol.items, td#button-wrapper-sc').on('click','.remove-item-button', function() {
        var remove_item_button = $(this);
        var idProduct = $(this).find('#id-product').val();
        var row_product = remove_item_button.parent().parent().parent();

        $.ajax({
            method: "post",
            url: "/remove/" + idProduct,
            data: { "_token": "{{ csrf_token() }}" },
            success: function( new_cart ) {

                if(new_cart[0] == 0)
                {
                    $('ol.items').children().remove();
                    $('#nav-total-price').remove();
                    $('div.cart-footer').remove();
                    $('span.hidden-xs').find('.text-primary').html('');

                    if(window.location.pathname == '/shopping-cart')
                    {
                        window.location.href = '/';
                    }

                    $('ol.items').append('<li style="text-align: center;"> Вашата количката е празна! </li>');
                }
                else
                {
                    $('#nav-total-price').html(new_cart[0]);
                    $('ol.items').children().remove();
                    $('sup.text-primary').html(new_cart[1]);
                    var items_obj = $.each( new_cart[2], function( _, value ){ value });

                    $.each(items_obj, function(product_id, value){
                        $('ol.items').append('<li><a href="#" class="product-image"><img src=" '+ value['item_pic'] +' "class="img-responsive"></a>'
                        +'<div class="product-details">'
                        +'<div class="close-icon">'
                        +'<button type="button" class="remove-item-button btn-danger" style="background: transparent; border-color: #ffffff; border-style: solid;">'
                        +'<input id="id-product" type="hidden" value="'+ product_id +'"/>'
                        +'<i class="fa fa-close" style="color: #ff0000"></i>'
                        +'</button>'
                        +'</div>'
                        +'<p class="product-name"> <a href="/store/'+ product_id +'" target="_blank">'+ value['item_title'] +'</a></p>'
                        +'<strong id="product-qty">'+ value['qty'] +'</strong> x <span class="price text-primary">'+ value['item_price'] +' лв.</span>'
                        +'</div></li>');
                     });

                    $('ol.items').append('<h5>Общо: <strong id="nav-total-price">'+ new_cart[0] +'</strong> <strong> лв.</strong></h5>');

                    if($('div.cart-footer').length < 1){
                        $('ul.dropdown-menu.cart.w-250').append(
                                '<li>'
                                + '<div class="cart-footer">'
                                + '<a href="/shopping-cart" class="pull-left"><i class="fa fa-cart-plus mr-5"></i> Количка</a>'
                                + '<a href="/checkout" class="pull-right"><i class="fa fa-money" aria-hidden="true"></i> Плащане</a>'
                                + '</div>'
                                + '</li>'
                        );
                    }

                    var buttons = $('.add-product-button.add_to_cart');

                    buttons.each(function(){

                        if($(this).find('#id-product').val() == idProduct)
                        {
                            $(this).find('#sup-product-qty').html('');
                            $(this).find('#quantity-product').val(1);
                        }
                    });

                    if(window.location.pathname == '/shopping-cart')
                    {
                        var row_tr = remove_item_button.parent().parent();
                        row_tr.remove();
                        quantityProduct = $(this).parent().parent().find('#quantity-product').val();
                    }

                    $('.price.totalPrice strong').html(new_cart[0]);

                }
            }
        });
    });
</script>


<script>
    $( ".add-product-button" ).click(function() {

        var add_product_button = $(this);
        var idProduct = $(this).find('#id-product').val();
        var quantityProductWrapper = $(this).find('#quantity-product');
        var quantityProduct = quantityProductWrapper.val();

        if ( typeof idProduct === "undefined"){
              idProduct = $('#id-product').val();
             quantityProduct = $('#quantity-product').val();
         }

        if(window.location.pathname == '/shopping-cart')
        {
            quantityProduct = $(this).parent().parent().find('#quantity-product').val();
        }

        $.ajax({
            method: "POST",
            url: "/store/add-to-cart/?product_id=" + idProduct + "&product_quantity=" + quantityProduct,
            data: { "_token": "{{ csrf_token() }}" },
            success: function( new_cart ) {

                $('#nav-total-price').html(new_cart[0]);
                $('ol.items').children().remove();
                $('sup.text-primary').html(new_cart[1]);
                var items_obj = $.each( new_cart[2], function( _, value ){ value });

                $.each(items_obj, function(product_id, value){
                    $('ol.items').append('<li><a href="#" class="product-image"><img src=" '+ value['item_pic'] +' "class="img-responsive"></a>'
                    + '<div class="product-details">'
                    + '<div class="close-icon">'
                    + '<button type="button" class="remove-item-button btn-danger" style="background: transparent; border-color: #ffffff; border-style: solid;" >'
                    + '<input id="id-product" type="hidden" value="'+ product_id +'"/>'
                    + '<i class="fa fa-close" style="color: #ff0000"></i>'
                    + '</button>'
                    + ' </div>'
                    + '<p class="product-name"> <a href="/store/'+ product_id +'" target="_blank">'+ value['item_title'] +'</a></p>'
                    + '<strong id="product-qty">'+ value['qty'] +'</strong> x <span class="price text-primary">'+ value['item_price'] +' лв.</span>'
                    + '</div></li>');
                });

                $('ol.items').append('<h5>Общо: <strong id="nav-total-price">'+ new_cart[0] +'</strong> <strong> лв.</strong></h5>');

                if($('div.cart-footer').length < 1){
                    $('ul.dropdown-menu.cart.w-250').append(
                            '<li>'
                            + '<div class="cart-footer">'
                            + '<a href="/shopping-cart" class="pull-left"><i class="fa fa-cart-plus mr-5"></i> Количка</a>'
                            + '<a href="/checkout" class="pull-right"><i class="fa fa-money" aria-hidden="true"></i> Плащане</a>'
                            + '</div>'
                            + '</li>'
                    );
                }

                add_product_button.find('#sup-product-qty').html(quantityProduct);
                add_product_button.find('#quantity-product').val(parseInt(quantityProduct) + 1);
                $('.price.totalPrice strong').html(new_cart[0]);
                add_product_button.parent().parent().find('strong#total-item-price').html(items_obj[idProduct]['total_item_price']);
            }
        });
    });
</script>

<link href="https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
<!--footer start from here-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 footer-col">
                <div class="logofooter"> {{ isset($siteViewInformation->address_com) ? $siteViewInformation->name_company : 'Logo' }}</div>
                @if(isset($siteViewInformation->description_com))
                <p>{!!  substr($siteViewInformation->description_com, 0, 300) !!}.....</p>
                @else
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
                @endif

                <p><i class="fa fa-map-pin"></i>Адрес: {{ isset($siteViewInformation->address_com) ? $siteViewInformation->address_com : 'City, Country' }}</p>
                <p><i class="fa fa-phone"></i>Тел.:  {{ isset($siteViewInformation->phone_com) ? $siteViewInformation->phone_com : '0888 888 888'}} </p>
                <p><i class="fa fa-envelope"></i> E-mail : {{ isset($siteViewInformation->phone_com) ? $siteViewInformation->email_com : 'example@com.com' }}</p>

            </div>
            <div class="col-md-3 col-sm-6 footer-col">
                <h6 class="heading7">Продукти</h6>
                <ul class="footer-ul">
                    @if (isset($subCategoriesButtonsName))
                        @foreach($subCategoriesButtonsName as $subCategoryButtonsName)
                            <li><a href="/store/search?category={{ $subCategoryButtonsName->identifier }}">{{ $subCategoryButtonsName->name }}</a></li>
                        @endforeach
                    @else
                        <li><a href="#"> Career</a></li>
                        <li><a href="#"> Privacy Policy</a></li>
                        <li><a href="#"> Terms & Conditions</a></li>
                        <li><a href="#"> Client Gateway</a></li>
                        <li><a href="#"> Ranking</a></li>
                        <li><a href="#"> Case Studies</a></li>
                        <li><a href="#"> Frequently Ask Questions</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 footer-col">
                <h6 class="heading7">Последни статии</h6>
                <div class="post">
                    <p>facebook crack the movie advertisment code:what it means for you <span>August 3,2015</span></p>
                    <p>facebook crack the movie advertisment code:what it means for you <span>August 3,2015</span></p>
                    <p>facebook crack the movie advertisment code:what it means for you <span>August 3,2015</span></p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 footer-col">
                <h6 class="heading7">Социални мрежи</h6>
                <ul class="footer-social">
                    <li><i class="fa fa-linkedin social-icon linked-in" aria-hidden="true"></i></li>
                    <li><i class="fa fa-facebook social-icon facebook" aria-hidden="true"></i></li>
                    <li><i class="fa fa-twitter social-icon twitter" aria-hidden="true"></i></li>
                    <li><i class="fa fa-google-plus social-icon google" aria-hidden="true"></i></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--footer start from here-->

<div class="copyright">
    <div class="container">
        <div class="col-md-12">
            <p style="text-align: center;">© 2015 - 2017  Streamline Tech </p>
        </div>

    </div>
</div>