@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <div class="basic-grey">
            <form action="{{ route('info_company.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label>
                    <span>Име на фирмата:</span>
                    <input type="text" name="name_company" value="{{ $info_company->name_company }}" class="label-values"/>
                </label>

                <label>
                    <span>Адрес:</span>
                    <textarea name="address_com" class="label-values"/> {{ $info_company->address_com }} </textarea>
                </label>

                <label>
                    <span>Имейл:</span>
                    <input type="text" name="email_com" value="{{ $info_company->email_com }}" class="label-values"/>
                </label>

                <label>
                    <span>Телефон:</span>
                    <input type="text" name="phone_com" value="{{ $info_company->phone_com }}" class="label-values"/>
                </label>

                <label>
                    <span>Работно време:</span>
                    <input type="text" name="work_time_com" value="{{ $info_company->work_time_com }}" class="label-values"/>
                </label>

                <label>
                    <span>Google Map:</span>
                    <textarea name="map_com" class="label-values"/> {{ $info_company->map_com }} </textarea>
                </label>

                <label class="basic-img-wrap">
                    <span >Logo: <a class="upload-basic-img-butt">Click to change</a></span>
                    <input style="padding-top: 10px;" type="text" value="{{ $info_company->logo_com }}" name="label-values" id="url-basic-image-field"/>

                </label>


                <script>
                    $(document).ready(function() {
                        var wrapper    = $(".basic-img-wrap");
                        var button_upload_basic_img = $(".upload-basic-img-butt");
                        var button_url_basic_img    = $(".field-basic-img-butt");

                        $(button_upload_basic_img).click(function(e){
                            e.preventDefault();
                            var change_picture =  confirm("Do you want to change the logo?");

                            if (change_picture == true){
                                $('.upload-basic-img-wrapp').remove();
                                $('#url-basic-image-field').remove();
                                $(wrapper).append('<input style="padding-top: 10px;" type="file" name="upload_logo_picture" class="label-values"/>');
                            }
                        });

                        $(wrapper).on("click", ".remove-url-basic-image", function(e){
                            e.preventDefault();
                            var r = confirm("Do you want to remove the main picture");
                            if(r == true) { $(this).parent('div.url-basic-image-field label').remove(); }
                        });
                    });
                </script>



                <br>
                <span><b>Описание на фирмата:</b></span>
                <label>
                    <textarea name="description_com"  id="editor-info-company-edit" >{{ $info_company->description_com }}</textarea>
                </label>

                <div class="actions">
                    <input type="submit" name="commit" value="Промяна на информацията за компанията" class="btn btn-success">
                </div>
            </form>
        </div>

        <script src="{{ URL::to('/') }}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

        <script>
            CKEDITOR.replace( 'editor-info-company-edit' );
        </script>

    @include('admin.admin_partials.admin_menu_bottom')
@endsection