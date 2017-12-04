@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <div class="basic-grey">
            <form action="{{ route('info_company.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <label>
                    <span>Име на фирмата:</span>
                    <input type="text" name="name_company" value="" class="label-values"/>
                </label>

                <label>
                    <span>Адрес:</span>
                    <textarea name="address_com" value=""  class="label-values"/></textarea>
                </label>

                <label>
                    <span>Имейл:</span>
                    <input type="text" name="email_com" value="" class="label-values"/>
                </label>

                <label>
                    <span>Телефон:</span>
                    <input type="text" name="phone_com" value="" class="label-values"/>
                </label>

                <label>
                    <span>Работно време:</span>
                    <input type="text" name="work_time_com" value="" class="label-values"/>
                </label>

                <label>
                    <span>Google Map:</span>
                    <textarea name="map_com" class="label-values"/></textarea>
                </label>

                <label>
                    <span >Logo:</span>
                    <input style="padding-top: 10px;" type="file" name="upload_logo_picture" class="label-values"/>
                </label>

                <br>
                <span><b>Описание на фирмата:</b></span>
                <label>
                    <textarea name="description_com" id="editor-info-company-create" ></textarea>
                </label>

                <div class="actions">
                    <input type="submit" name="commit" value="Запис" class="btn btn-success">
                </div>

            </form>
        </div>

        <script src="{{ URL::to('/') }}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

        <script>
            CKEDITOR.replace( 'editor-info-company-create' );
        </script>

    @include('admin.admin_partials.admin_menu_bottom')
@endsection