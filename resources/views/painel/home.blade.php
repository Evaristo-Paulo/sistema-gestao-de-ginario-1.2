@extends('painel.template')
@section('title-page')
Painel de Controle
@endsection

@section('main-content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-md-4 mt-5 mb-3">
            <div class="card">
                <div class="seo-fact sbg1">
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon"><a href="{{ route('worker.list') }}"><i class="fa fa-users" aria-hidden="true"></i> Funcionários</a></div>
                        <h2>{{ $workers }}</h2>
                    </div>
                    <canvas id="seolinechart1" height="50"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-md-5 mb-3">
            <div class="card">
                <div class="seo-fact sbg2">
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon"><a href="{{ route('client.list') }}"><i class="fa fa-child" aria-hidden="true"></i> Clientes</a></div>
                        <h2>{{ $clients }}</h2>
                    </div>
                    <canvas id="seolinechart2" height="50"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-md-5 mb-3">
            <div class="card">
                <div class="seo-fact sbg4">
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon"><a href="{{ route('payment.relatory.debt') }}"><i class="fa fa-question" aria-hidden="true"></i> Devedores</a></div>
                        <h2>{{ $cont_debt_clients }}</h2>
                    </div>
                    <canvas id="seolinechart2" height="50"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- seo fact area end -->
@endsection

@push('css')
<style>
    .main-content-inner .seo-fact a{
    color: #fff
}
.main-content-inner .row > div > div:hover {
    animation-name: up;
    animation-duration: .5s;
    animation-timing-function: ease-in-out;
    animation-fill-mode: forwards
}
@keyframes up{
    0%{ transform: translateY(0px) }
    100%{ transform: translateY(-10px) }
}

</style>
    
@endpush