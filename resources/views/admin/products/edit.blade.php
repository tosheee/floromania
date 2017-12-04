@extends('layouts.app')

@section('content')

    @include('admin.admin_partials.admin_menu')
        <div class="basic-grey">
            <form method="POST" action="/admin/products/{{ $product->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('product_id') ? ' has-error' : '' }}">
                    <label>
                        <span>Категории:</span>
                        <select class="form-control" name="category_id" id="select-category">
                            <option value="">Избери категория</option>
                            @foreach($categories as $category)
                                @if ($product->category_id == $category->id )
                                    <option selected="selected" value="{{ $category->id }}">{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </label>
                </div>

                <div class="form-group{{ $errors->has('sub_category_id') ? ' has-error' : '' }}">
                    <label>
                        <span>Подкатегории:</span>
                        <select class="form-control" name="sub_category_id" id="select-sub-category">
                            <option value="">Избери подкатегории</option>
                            @foreach($subCategories as $sub_category)
                                @if ($product->sub_category_id == $sub_category->id )
                                    <option selected="selected" value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                @else
                                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </label>
                </div>

                <div class="form-group{{ $errors->has('identifier') ? ' has-error' : '' }}">
                    <label>
                        <span>Идентификатор:</span>
                        <select class="form-control" name="identifier" id="select-identifier">
                            <option value="">Избери идентификатор</option>
                            @foreach($subCategories as $sub_category)
                                @if ($product->identifier == $sub_category->identifier )
                                    <option selected="selected" value="{{ $sub_category->identifier }}">{{ $sub_category->identifier }}</option>
                                @else
                                    <option value="{{ $sub_category->identifier }}">{{ $sub_category->identifier }}</option>
                                @endif
                            @endforeach
                        </select>
                    </label>
                </div>

                <label>
                    <span style="margin: 0;">Активен продукт в магазина: </span>
                    <input type="radio" name="active" value="1" {{ $product->active == 1 ? 'checked' : '' }}> ДА
                    <input type="radio" name="active" value="0" {{ $product->active == 1 ? '' : 'checked' }}> НЕ
                </label>
                <br>

                <?php $descriptions = json_decode($product->description, true); ?>
                <label>
                    <span>Каталожен номер:</span>
                    <input type="text" name="description[article_id]" value="{{ isset($descriptions['article_id']) ? $descriptions['article_id'] : '' }}" id="admin_product_description" class="label-values"/>
                </label>

                <label>
                    <span>Име на продукта:</span>
                    <input type="text" name="description[title_product]" value="{{ isset($descriptions['title_product']) ? $descriptions['title_product'] : '' }}" id="admin_product_description" class="label-values"/>
                </label>

                <label>
                    <span style="margin: 0;">Разпродажба: </span>
                    <input type="radio" name="sale" value="1" {{ $product->active == 1 ? '' : 'checked' }}> ДА
                    <input type="radio" name="sale" value="0" {{ $product->active == 1 ? 'checked' : '' }}> НЕ
                </label>
                <br>

                <label>
                    <span style="margin: 0;">Препоръчан: </span>
                    <input type="radio" name="recommended" value="1" {{ $product->recommended == 1 ? 'checked' : '' }}> ДА
                    <input type="radio" name="recommended" value="0" {{ $product->recommended == 1 ? '' : 'checked' }}> НЕ
                </label>
                <br>

                <label>
                    <span style="margin: 0;">Най - продаван: </span>
                    <input type="radio" name="best_sellers" value="1" {{ $product->best_sellers == 1 ? 'checked' : '' }}> ДА
                    <input type="radio" name="best_sellers" value="0" {{ $product->best_sellers == 1 ? '' : 'checked' }}> НЕ
                </label>
                <br>

                <label>
                    <span style="margin: 0;">Наличност: </span>
                    <input type="radio" name="description[product_status]" value="Наличен" checked> Наличен:
                    <input type="radio" name="description[product_status]" value="По поръчка"> По поръчка:
                    <input type="radio" name="description[product_status]" value="Не е наличен"> Не е наличен:
                </label>

                <label>
                    <span>Доставна цена:</span>
                    <input type="text" name="description[delivery_price]" value="{{ isset($descriptions['delivery_price']) ? $descriptions['delivery_price'] : '' }}" id="admin_product_description" class="label-values"/>
                </label>


                <label>
                    <span>Цена в магазина:</span>
                    <input type="text" name="description[price]" value="{{ isset($descriptions['price']) ? $descriptions['price'] : '' }}" id="admin_product_description" class="label-values"/>
                </label>

                <label>
                    <span>Стара цена:</span>
                    <input type="text" name="description[old_price]" value="{{ isset($descriptions['old_price']) ? $descriptions['old_price'] : '' }}" id="admin_product_description" class="label-values"/>
                </label>

                <label>
                    <span style="margin: 0;">Валута:</span>
                    <input type="radio" name="description[currency]" value="лв." checked> BGN:
                    <input type="radio" name="description[currency]" value="euro"> EUR:
                    <input type="radio" name="description[currency]" value="usd">  USD:
                </label>
                <br>

                <label>
                    <span>Късо описание на продукта:</span>
                    <textarea name="description[short_description]" value="" id="admin_product_description" class="label-values"/>
                    {{ isset($descriptions['short_description']) ? $descriptions['short_description'] : '' }}
                    </textarea>
                </label>

                <span>Описание на продукта:</span>
                <label>
                    @if(isset($descriptions['general_description']))
                        <textarea name="description[general_description]" id="editor-edit" >{!! $descriptions['general_description'] !!}</textarea>
                    @else
                        <textarea name="description[general_description]" id="editor-edit" ></textarea>
                    @endif
                </label>
                <br>

                <div class="basic-img-wrap">
                    <button class="upload-basic-img-butt btn btn-info btn-xs">Добавяне на основна сминка от файл</button>
                    <button class="field-basic-img-butt btn btn-warning btn-xs">Добавяне на основна снимка от линк</button>
                    <br>
                    <br>

                    @if (isset($descriptions['main_picture_url']))
                        <div class="url-basic-image-field" >
                            <label>
                                <span>Линк на основна снимка:</span>
                                <input type="text" name="description[main_picture_url]" value="{{ isset($descriptions['main_picture_url']) ? $descriptions['main_picture_url'] : '' }}" id="admin_product_description" class="label-values"/>
                                <a href="#" class="remove-url-basic-image"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>
                            </label>
                        </div>
                    @endif

                    <script>
                        $(document).ready(function() {
                            var wrapper    = $(".basic-img-wrap");
                            var button_upload_basic_img = $(".upload-basic-img-butt");
                            var button_url_basic_img    = $(".field-basic-img-butt");

                            $(button_url_basic_img).click(function(e){
                                e.preventDefault();
                                var change_picture =  confirm("Do you want to change the main picture?");

                                if (change_picture == true){
                                    $('.upload-basic-img-wrapp').remove();
                                    $('.url-basic-image-field').remove();
                                    $(wrapper).append('<div class="url-basic-image-field" ><label><span>Линк на основна снимка:</span>' +
                                        '<input type="text" name="description[main_picture_url]" value="" id="admin_product_description" class="label-values"/>' +
                                        '<a href="#" class="remove-url-basic-image">' +
                                        '<i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                                        '</label></div>');
                                }
                            });

                            $(wrapper).on("click", ".remove-url-basic-image", function(e){
                                e.preventDefault();
                                var r = confirm("Do you want to remove the main picture");
                                if(r == true) { $(this).parent('div.url-basic-image-field label').remove(); }
                            });
                        });
                    </script>

                    @if (isset($descriptions['upload_main_picture']))
                        <div class="upload-basic-img-wrapp" >
                            <label>
                                <span>Добавяне на снимка от файл:</span>
                                <input type="text" name="description[upload_main_picture]" value="{{ $descriptions['upload_main_picture'] }}" id="admin_product_description" class="label-values"/>
                                <a href="#" class="remove-img-upload-button"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>
                            </label>
                        </div>
                    @endif

                    <script>
                        $(document).ready(function() {
                            var wrapper    = $(".basic-img-wrap");
                            var button_upload_basic_img = $(".upload-basic-img-butt");
                            var button_url_basic_img    = $(".field-basic-img-butt");

                            $(button_upload_basic_img).click(function(e){
                                e.preventDefault();
                                var change_picture = confirm("Do you want to change the main picture?")
                                if (change_picture == true) {
                                    $('.upload-basic-img-wrapp').remove();
                                    $('.url-basic-image-field').remove();

                                    $(wrapper).append('<div class="upload-basic-img-wrapp">' +
                                        '<input type="file" name="upload_main_picture" class="label-values"/>' +
                                        '<a href="#" class="remove-img-upload-button">' +
                                        '<i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                                        '</div>');
                                }
                            });

                            $(wrapper).on("click", ".remove-img-upload-button", function(e){
                                var r =  confirm("Do you want to remove the main picture?");
                                e.preventDefault();
                                if(r == true) { $('div.upload-basic-img-wrapp').remove(); }
                            });
                        });
                    </script>

                </div>

                <div class="input_fields_wrap">
                    <button class="upload-img-gallery-button btn btn-info btn-xs">Добавяне на снимка в галерия от файл </button>
                    <button class="field-img-gallery-button btn btn-warning btn-xs">Добавяне на снимка от линк</button>
                    <br>

                    <br>
                    <?php ?>
                    @if(isset($descriptions['gallery']))
                        @foreach ($descriptions['gallery'] as $description)
                            @if(isset($description["picture_url"]))
                                <div class="gallery-fields">
                                    <label>
                                        <span>Линкове на снимки в галерията:</span>
                                        <input type="text" name="description[gallery][][picture_url]" value="{{ $description["picture_url"] }}">
                                        <a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>
                                    </label>
                                </div>
                            @endif

                            @if(isset($description["upload_picture"]))
                                <div class="gallery-fields">
                                    <label>
                                        <span>Добавяне на снимка то  :</span>
                                        <input type="text" name="description[gallery][][upload_picture]" value="{{ $description["upload_picture"] }}">
                                        <a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>


                <script>

                    $(document).ready(function() {
                    $( "#select-category" ).change(function() {
                        var category_val =  $( "#select-category option:selected" ).val();
                        $("#select-sub-category").children().remove();

                        $.ajax({
                            method: "POST",
                            url: "/admin/products/create/" + category_val,
                            data: { "_token": "{{ csrf_token() }}" },
                            success: function( msg ) {
                                $("#select-sub-category").append("<option value=''>Избери подкатегория</option>");
                                for(var i = 0; i < msg.length; i++ ){
                                    $("#select-sub-category").append("<option value=" + msg[i][0] + ">" + msg[i][1] + "</option>");
                                }

                                $( "#select-sub-category" ).change(function() {
                                    var sub_category_val =  $( "#select-sub-category option:selected" ).val();
                                    console.log(sub_category_val);
                                    $("#select-identifier").children().remove();


                                    for(var j = 0; j < msg.length; j++){
                                        if(sub_category_val == msg[j][0]){
                                            $("#select-identifier").append("<option value=" + msg[j][2] +">" + msg[j][2] + "</option>");
                                        }
                                    }
                                });
                            }
                        });
                    });
                    });

                    $(document).ready(function() {
                        var max_fields = 5;
                        var wrapper    = $(".input_fields_wrap");
                        var upload_img_gallery_button = $(".upload-img-gallery-button");
                        var field_img_gallery_button  = $(".field-img-gallery-button");
                        var x = $('.gallery-fields').length;

                        $(field_img_gallery_button).click(function(e){
                            e.preventDefault();
                            if(x < max_fields){
                                x++;
                                $(wrapper).append(
                                        '<div class="gallery-fields" ><label><span>Линкове на снимки в галерията:</span>' +
                                        '<input type="text" name="description[gallery][][picture_url]"/>' +
                                        '<a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                                        '</label></div>');
                            }
                        });
                        $(wrapper).on("click",".remove_field", function(e){
                            e.preventDefault(); $(this).parent('div.gallery-fields label').remove(); x--;
                        });


                        $(upload_img_gallery_button).click(function(e){
                            e.preventDefault();
                            if(x < max_fields){
                                x++;
                                $(wrapper).append('<div class="upload-img-gallery-button">' +
                                '<input type="file" name="upload_gallery_pictures[]" class="label-values"/>' +
                                '<a href="#" class="remove-img-gallery-button">' +
                                '<i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                                '</div>');
                            }
                        });

                        $(wrapper).on("click",".remove-img-gallery-button", function(e){
                            e.preventDefault();
                            $(this).parent('div.upload-img-gallery-button').remove();
                            x--;
                        });
                    });
                </script>

                <div class="specification_fields_wrap">
                    <button class="add_spec_field_button btn-primary btn-xs">Добавяне на спецификация</button>
                    <br>
                    <br>
                    @if(isset($descriptions['properties']))
                        @foreach( $descriptions['properties'] as $key => $property)
                            @if ($key % 2 == 0)
                                <div class="fields">
                                    <label>
                                       <input style="width: 200px" type="text" name="description[properties][][name]" id="admin_product_description" class="label-names" value="{{ $property['name'] }}">
                                    @else
                                        <input type="text" name="description[properties][][text]" id="admin_product_description" class="label-values" value="{{ $property['text'] }}">
                                        <a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    @endif

                    @if(isset($descriptions['properties']))
                        @foreach( $descriptions['properties'] as $key => $property)
                            @if ($key % 2 == 0)
                            <div class="fields">
                                <label>
                                    <input style="width: 200px" type="text" name="description[properties][][name]" id="admin_product_description" class="label-names" value="{{ $property['name'] }}">
                            @else
                                    <input type="text" name="description[properties][][text]" id="admin_product_description" class="label-values" value="{{ $property['text'] }}">
                                    <a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>
                                </label>
                            </div>
                            @endif
                        @endforeach
                    @endif
                </div>

                <div class="actions">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="submit" name="commit" value="Обновяване" class="btn btn-success">
                </div>
            </form>

        </div>


        <script>
            // specification
            $(document).ready(function() {
                var max_fields      = 20; //maximum input boxes allowed
                var wrapper         = $(".specification_fields_wrap"); //Fields wrapper
                var add_button      = $(".add_spec_field_button"); //Add button ID
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append(
                                '<div class="fields" ><label>' +
                                '<input style="width: 200px" type="text" name="description[properties][][name]" id="admin_product_description" class="label-names">' +
                                '                     <input type="text" name="description[properties][][text]" id="admin_product_description" class="label-values">' +
                                '<a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                                '</label></div>'); //add input box
                    }
                });
                $(wrapper).on("click", ".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div.fields label').remove(); x--;
                });
            });

            $('[id^="btnO"]').click(function() {
                var notchecked = $('input[type="radio"][name="menucolor"]').not(':checked');
                $('.navbar.'+notchecked.val()).toggleClass('navbar-default navbar-inverse');
                notchecked.prop("checked", true);
                $(this).parent().find('a').each(function() {
                    if($(this).attr('id') == 'btnOn'){
                        $(this).toggleClass('active btn-success btn-default');
                    } else {
                        $(this).toggleClass('active btn-danger btn-default');
                    }

                });
                doChange(notchecked);
            });

            $('input[type="radio"][name="menucolor"]').change(function() {
                doChange(this);
            });

            function doChange(object){
                if($(object).val() == "navbar-default"){
                    $('#btnOn').removeClass('active');
                    $('#btnOn .glyphicon-ok').css('opacity','0');
                    $('#btnOff .glyphicon-remove').css('opacity','1');
                    $('#btnOff').focus();
                }
                if($(object).val() == "navbar-inverse"){
                    $('#btnOff').removeClass('active');
                    $('#btnOff .glyphicon-remove').css('opacity','0');
                    $('#btnOn .glyphicon-ok').css('opacity','1');
                    $('#btnOn').focus();
                }
            }
        </script>

        <script src="{{ URL::to('/') }}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

        <script>
            CKEDITOR.replace( 'editor-edit' );
        </script>
    @include('admin.admin_partials.admin_menu_bottom')
@endsection
