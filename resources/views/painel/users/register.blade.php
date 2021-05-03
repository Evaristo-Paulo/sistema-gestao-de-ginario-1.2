@extends('painel.template')
@section('main-title-page')
Registo de Usuários -
@endsection
@section('title-page')
Registo de Usuários
@endsection
@section('main-content')
<div class="row">
    <div class="col-lg-12 col-ml-12">

        <div class="row">
            <div class="col-12 mt-5">
                @if( session('password-different') )
                            <ul class="alert alert-warning " role="alert">
                                <li><i class="fa fa-warning"></i> {{ session('password-different') }}</li>
                            </ul>
                        @endif
                        @if( session('update-auth') )
                            <ul class="alert alert-warning " role="alert">
                                <li><i class="fa fa-warning"></i> {{ session('update-auth') }}</li>
                            </ul>
                        @endif
                        @if( session('create-auth') )
                            <ul class="alert alert-warning " role="alert">
                                <li><i class="fa fa-warning"></i> {{ session('create-auth') }}</li>
                            </ul>
                        @endif
                        @if( session('user-not-found') )
                            <ul class="alert alert-warning " role="alert">
                                <li><i class="fa fa-warning"></i> {{ session('user-not-found') }}</li>
                            </ul>
                        @endif
                        @if( session('error') )
                            <ul class="alert alert-warning " role="alert">
                                <li><i class="fa fa-warning"></i> {{ session('error') }}</li>
                            </ul>
                        @endif
                        @if( session('error-exception') )
                            <ul class="alert alert-warning " role="alert">
                                <li><i class="fa fa-warning"></i> {{ session('error-exception') }}</li>
                            </ul>
                        @endif
                        @if( session('created') )
                            <ul class="alert alert-success " role="alert">
                                <li><i class="fa fa-check"></i> {{ session('created') }}</li>
                            </ul>
                        @endif
                        @if( session('password-changed') )
                            <ul class="alert alert-success " role="alert">
                                <li><i class="fa fa-check"></i> {{ session('password-changed') }}</li>
                            </ul>
                        @endif
                        @if( session('warning') )
                            <ul class="alert alert-warning " role="alert">
                            <li><i class="fa fa-warning"></i> {{ session('warning') }}</li>
                            </ul>
                         @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <form class="card-body" method="POST" action="{{ route('user.register') }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="name" class="col-form-label">
                                    Nome Completo <span class="required">*</span></label>
                                <input class="form-control" required type="text" value="{{ old('name') }}"
                                    id="name" name="name">
                            </div>

                            <div class="col-sm-6">
                                <label for="email" class="col-form-label">
                                    Email <span class="required">*</span></label>
                                <input class="form-control" required type="email" value="{{ old('email') }}"
                                    name="email" id="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label d-block">Gênero <span class="required">*</span></label>
                                    @foreach( $genders as $index => $value )
                                        <div class="custom-control custom-radio">
                                            @if($value->type == 'Masculino')
                                                <input type="radio" checked id="{{ $value->type }}" name="gender"
                                                    class="custom-control-input" value="{{ $value->id }}">
                                            @else
                                                <input type="radio" id="{{ $value->type }}" name="gender"
                                                    class="custom-control-input" value="{{ $value->id }}">
                                            @endif
                                            <label class="custom-control-label"
                                                for="{{ $value->type }}">{{ $value->type }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label d-block">Role <span class="required">*</span></label>
                                    @foreach( $roles as $index => $value )
                                        <div class="custom-control custom-checkbox">
                                            @if($value->type == 'User')
                                                <input type="checkbox" checked class="custom-control-input"
                                                    id="{{ $value->type }}" name="role[]"
                                                    value="{{ $value->type }}">
                                            @else
                                                <input type="checkbox" class="custom-control-input"
                                                    id="{{ $value->type }}" name="role[]"
                                                    value="{{ $value->type }}">
                                            @endif
                                            <label class="custom-control-label"
                                                for="{{ $value->type }}">{{ $value->type }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password" class="col-form-label">
                                        Senha <span class="required">*</span></label>
                                    <input class="form-control" required type="password" name="password" id="password">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Enviar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- seo fact area end -->
@endsection
