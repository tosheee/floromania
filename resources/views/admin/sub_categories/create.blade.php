@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Създай подкатегория</div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="{{ route('sub_categories.store') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                    <label for="category_id" class="col-md-4 control-label">Категория</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="category_id">
                                            <option value="">Избери категория</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Подкатегория</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('identifier') ? ' has-error' : '' }}">
                                    <label for="identifier" class="col-md-4 control-label">Идентификатор</label>
                                    <div class="col-md-6">
                                        <input id="identifier" type="text" class="form-control" name="identifier" required autofocus>
                                        @if ($errors->has('identifier'))
                                            <span class="help-block"><strong>{{ $errors->first('identifier') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">Създай</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('admin.admin_partials.admin_menu_bottom')
@endsection
