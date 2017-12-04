@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')

        @if(isset($info_company))
            <a class="btn btn-default" href="/admin/info_company/{{ $info_company->id }}/edit">Промяна</a>

            <form method="POST" action="/admin/info_company/{{ $info_company->id }}" accept-charset="UTF-8" class="pull-right">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="DELETE">
                <input class="btn btn-danger" type="submit" value="Изтриване">
            </form>

            <br>
            <br>
            <p><b>Име на компанията: </b>{{ $info_company->name_company }}</p>
            <p><b>Адрес: </b>{{ $info_company->address_com }}</p>
            <p><b>Имейл: </b>{{ $info_company->email_com }}</p>
            <p><b>Телефон: </b>{{ $info_company->phone_com }}</p>
            <p><b>Лого: </b>{{ $info_company->logo_com }}</p>
            <p><b>Работно време: </b>{{ $info_company->work_time_com }}</p>
            <p><b>Описание: </b>{!! $info_company->description_com !!}</p>
            <p><b>Google map: </b>{{ $info_company->map_com }}</p>
        @else
            <p>Няма информация</p>
            <a class="btn btn-primary" href="/admin/info_company/create">Създай информация за сайта</a>
        @endif

    @include('admin.admin_partials.admin_menu_bottom')
@endsection