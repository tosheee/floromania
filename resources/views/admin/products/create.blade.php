@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')
        <div class="basic-grey">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                    <label>
                        <span>Категории:</span>
                        <select class="form-control" name="category_id" id="select-category">
                            <option value="">Избери категория</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <div class="form-group{{ $errors->has('sub_category_id') ? ' has-error' : '' }}">
                    <label>
                        <span>Подкатегория:</span>
                        <select class="form-control" name="sub_category_id" id="select-sub-category">
                            <option value="">Избери подкатегория</option>
                            @foreach($subCategories as $sub_category)
                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
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
                                <option value="{{ $sub_category->identifier }}">{{ $sub_category->identifier }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <label>
                    <span style="margin: 0;">Активен продукт в магазина: </span>
                    <input type="radio" name="active" value="1" checked> ДА
                    <input type="radio" name="active" value="0"> НЕ
                </label>
                <br>

                <label>
                    <span>Каталожен номер:</span>
                    <input type="text" name="description[article_id]" value="" id="admin_product_description" class="label-values"/>
                </label>

                <label>
                    <span>Име на продукта:</span>
                    <input type="text" name="description[title_product]" value="" id="admin_product_description" class="label-values"/>
                </label>

                <label>
                    <span style="margin: 0;">В разпродажба: </span>
                    <input type="radio" name="sale" value="0" checked> НЕ
                    <input type="radio" name="sale" value="1" > ДА
                </label>
                <br>

                <label>
                    <span style="margin: 0;">Препоръчан: </span>
                    <input type="radio" name="recommended" value="0" checked> НЕ
                    <input type="radio" name="recommended" value="1"> ДА
                </label>
                <br>

                <label>
                    <span style="margin: 0;">Най - продаван: </span>
                    <input type="radio" name="best_sellers" value="0" checked> НЕ
                    <input type="radio" name="best_sellers" value="1"> ДА
                </label>
                <br>

                <label>
                    <span style="margin: 0;">Наличност: </span>
                    <input type="radio" name="description[product_status]" value="Наличен" checked> Наличен:
                    <input type="radio" name="description[product_status]" value="По поръчка"> По поръчка:
                    <input type="radio" name="description[product_status]" value="Не е наличен"> Не е наличен:
                </label>
                <br>

                <label>
                    <span>Доставна цена:</span>
                    <input type="text" name="description[delivery_price]" value="" id="admin_product_description" class="label-values"/>
                </label>

                <label>
                    <span>Цена в магазина:</span>
                    <input type="text" name="description[price]" value="" id="admin_product_description" class="label-values"/>
                </label>

                <label>
                    <span>Стара цена:</span>
                    <input type="text" name="description[old_price]" value="" id="admin_product_description" class="label-values"/>
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
                    <textarea name="description[short_description]" value="" id="admin_product_description" class="label-values"/></textarea>
                </label>

                <span>Описание на продукта:</span>
                <label>
                    <textarea name="description[general_description]" id="editor-create" ></textarea>
                </label>

                <br>

                <div class="basic-img-wrap">
                    <button class="upload-basic-img-butt btn btn-info btn-xs">Добавяне на основна снимка от файл</button>
                    <button class="field-basic-img-butt btn btn-warning btn-xs">Добавяне на основна снимка от линк</button>
                    <br>
                    <br>
                </div>

                <div class="input_fields_wrap">
                    <button class="upload-img-gallery-button btn btn-info btn-xs">Добавяне на снимка в галерия от файл</button>
                    <button class="field-img-gallery-button btn btn-warning btn-xs">Добавяне на снимка от линк</button>
                    <br>
                    <br>
                </div>

                <div class="specification_fields_wrap">
                    <button class="add_spec_field_button btn-primary btn-xs">Добавяна на спецификация</button>
                    <br>
                    <br>
                </div>

                <div class="actions">
                    <input type="submit" name="commit" value="Създай" class="btn btn-success">
                </div>
            </form>
        </div>

        <script>
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
                                    $("#select-identifier").append("<option value="+ msg[j][2] +">" + msg[j][2] + "</option>");
                                }
                            }
                        });
                    }
                });
            });

            $(document).ready(function() {
                var max_fields = 2;
                var wrapper    = $(".basic-img-wrap");
                var button_upload_basic_img = $(".upload-basic-img-butt");
                var button_url_basic_img    = $(".field-basic-img-butt");
                var x = 1;
                $(button_url_basic_img).click(function(e){
                    e.preventDefault();
                    if(x < max_fields){
                        x++;
                        $(wrapper).append('<div class="url-basic-image-field" ><label><span>Основна снимка от линк:</span>' +
                        '<input type="text" name="description[main_picture_url]" value="" id="admin_product_description" class="label-values"/>' +
                        '<a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                        '</label></div>');
                    }
                });
                $(wrapper).on("click", ".remove_field", function(e){
                    e.preventDefault(); $(this).parent('div.url-basic-image-field label').remove(); x--;
                });
                $(button_upload_basic_img).click(function(e){
                    e.preventDefault();
                    if(x < max_fields){
                        x++;
                        $(wrapper).append('<div class="upload-basic-img-wrapp">' +
                        '<input type="file" name="upload_main_picture" class="label-values"/>' +
                        '<a href="#" class="remove-img-upload-button">' +
                        '<i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                        '</div>');
                    }
                });
                $(wrapper).on("click", ".remove-img-upload-button", function(e){
                    e.preventDefault(); $(this).parent('div.upload-basic-img-wrapp').remove(); x--;
                });
            });

            // gallery images
            $(document).ready(function() {
                var max_fields = 6;
                var wrapper    = $(".input_fields_wrap");
                var upload_img_gallery_button = $(".upload-img-gallery-button");
                var field_img_gallery_button  = $(".field-img-gallery-button");
                var x = 1;
                $(field_img_gallery_button).click(function(e){
                    e.preventDefault();
                    if(x < max_fields){
                        x++;
                        $(wrapper).append(
                                '<div class="fields" ><label><span>Снимка в галерията от линк:</span>' +
                                '<input type="text" name="description[gallery][][picture_url]"/>' +
                                '<a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                                '</label></div>');
                    }
                });
                $(wrapper).on("click",".remove_field", function(e){
                    e.preventDefault(); $(this).parent('div.fields label').remove(); x--;
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
                    e.preventDefault(); $(this).parent('div.upload-img-gallery-button').remove(); x--;
                });
            });
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
            CKEDITOR.replace( 'editor-create' );
        </script>
    @include('admin.admin_partials.admin_menu_bottom')
@endsection