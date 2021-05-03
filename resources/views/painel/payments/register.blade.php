@extends('painel.template')
@section('main-title-page')
Registo de Pagamento -
@endsection
@section('title-page')
Registo de Pagamento
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
                    <form class="card-body" method="POST" action="{{ route('payment.register') }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="client" class="col-form-label">
                                    Cliente <span class="required">*</span></label>
                                <select class="select2_single form-control wizard-required"  tabindex="-1" required="required" id="client"
                                    name="client">
                                    <option value="" disabled selected>Selecionar cliente</option>
                                    @foreach ($clients as $client )
                                        <option value="{{  $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="status" class="col-form-label">
                                    Estado <span class="required">*</span></label>
                                <select class="select2_single form-control wizard-required" tabindex="-1" required="required" id="status"
                                    name="status">
                                    <option value="" disabled selected>Selecionar estado</option>
                                    <option value="Pagamento no prazo">Pagamento no Prazo</option>
                                    <option value="Liquidação da dívida">Liquidação de dívida</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="month" class="col-form-label">
                                    Mês <span class="required">*</span></label>
                                <select class="select2_single form-control wizard-required" tabindex="-1" required="required" id="month"
                                    name="month">
                                    <option value="" disabled selected>Selecionar mês</option>
                                    @foreach ($months as $month )
                                        <option value="{{  $month->id }}">{{ $month->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="year" class="col-form-label">
                                    Ano <span class="required">*</span></label>
                                <input class="form-control" required type="number" value="{{ old('year') }}"
                                    id="year" name="year">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="value" class="col-form-label">
                                    Valor (kz) <span class="required">*</span></label>
                                <input class="form-control wizard-required" required type="number" value="{{ old('value') }}"
                                    id="value" name="value">
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

@push('css')
@endpush