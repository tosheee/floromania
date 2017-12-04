@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

        <div class="basic-grey">
            <form class="form-horizontal" method="POST" action="{{ route('pages.store') }}">
                {{ csrf_field() }}

                <label>
                    <span>Име на страницата:</span>
                    <input type="text" name="name_page" value="" id="admin_product_description" class="label-values"/>
                </label>

                <label>
                    <span style="margin: 0;">Активна страница: </span>
                    <input type="radio" name="active_page" value="1" checked> Да:
                    <input type="radio" name="active_page" value="0"> Не:
                </label>
                <br>

                <label>
                    <span>Идентификатор:</span>
                    <input type="text" name="url_page" value="" id="admin_product_description" class="label-values"/>
                </label>

                <span>Съдържание:</span>
                <label>
                    <textarea name="content" id="editor-page-create" ></textarea>
                </label>

                <div class="actions">
                    <input type="submit" name="commit" value="Създаване на страница" class="btn btn-success">
                </div>
            </form>
        </div>

        <script src="{{ URL::to('/') }}/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

        <script>
            CKEDITOR.replace( 'editor-page-create', { height: 800 } );
        </script>
    @include('admin.admin_partials.admin_menu_bottom')
@endsection
