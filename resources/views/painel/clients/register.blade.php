@extends('painel.template')
@section('main-title-page')
Registo de Clientes -
@endsection
@section('title-page')
Registo de Clientes
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
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                                @if(session('warning'))
                                    <div class="page-header" id="notification-warning">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <i class="ti-check"></i> {{ session('warning') }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(session('success'))
                                    <div class="page-header" id="notification-success">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <i class="ti-check"></i> {{ session('success') }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="page-header" id="notification-error">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <i class="ti-check"></i> {{ session('error') }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="x_content">
                                    <div class="payment">
                                        <section class="wizard-section">
                                            <div class="row no-gutters">
                                                <div class="col-lg-12 col-md-6">
                                                    <div class="form-wizard">
                                                        <form role="form" method="POST" action="{{ route('client.register') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}

                                                            <div class="form-wizard-header">
                                                                <p>Preenche todos os campos do formulário</p>
                                                                <ul class="list-unstyled form-wizard-steps clearfix"
                                                                    style="display: flex; justify-content: center">
                                                                    <li class="active"><span>1</span></li>
                                                                    <li><span>2</span></li>
                                                                </ul>
                                                            </div>
                                                            <fieldset class="wizard-fieldset show">
                                                                <h5>Dados pessoais/Contacto</h5>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <label for="name" class="col-form-label">
                                                                            Nome Completo <span class="required">*</span></label>
                                                                        <input class="form-control wizard-required" required type="text" value="{{ old('name') }}"
                                                                            id="name" name="name">
                                                                            <div class="wizard-form-error"></div>
                                                                    </div>
                                        
                                                                    <div class="col-sm-6">
                                                                        <label for="birthday" class="col-form-label">
                                                                            Data de Nascimento <span class="required">*</span></label>
                                                                        <input class="form-control wizard-required" required type="date" value="{{ old('birthday') }}"
                                                                            name="birthday" id="birthday">
                                                                            <div class="wizard-form-error"></div>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
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
                                                                    <div class="col-sm-6">
                                                                        <label for="bi" class="col-form-label">
                                                                            Nº BI <span class="required">*</span></label>
                                                                        <input class="form-control wizard-required" type="text" value="{{ old('bi')}}" name="bi" id="bi">
                                                                        <div class="wizard-form-error"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <label for="phone" class="col-form-label">
                                                                            Telefone <span class="required">*</span></label>
                                                                        <input class="form-control wizard-required" required type="text" value="{{ old('phone') }}"
                                                                            id="phone" name="phone">
                                                                            <div class="wizard-form-error"></div>
                                                                    </div>
                                        
                                                                    <div class="col-sm-6">
                                                                        <label for="email" class="col-form-label">
                                                                            Email <span class="required">*</span></label>
                                                                        <input class="form-control wizard-required" required type="email" value="{{ old('email') }}"
                                                                            name="email" id="email">
                                                                            <div class="wizard-form-error"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group clearfix">
                                                                    <a href="javascript:;"
                                                                        class="form-wizard-next-btn float-right">Próximo</a>
                                                                </div>
                                                            </fieldset>
                                                            <fieldset class="wizard-fieldset">
                                                                <h5>Endereço</h5>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <label for="hood" class="col-form-label">
                                                                            Bairro <span class="required">*</span></label>
                                                                        <input class="form-control wizard-required" required type="text" value="{{ old('hood') }}"
                                                                            name="hood" id="hood">
                                                                            <div class="wizard-form-error"></div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label for="street" class="col-form-label">
                                                                            Rua <span class="required">*</span></label>
                                                                        <input class="form-control wizard-required" required type="text" value="{{ old('street') }}"
                                                                            id="street" name="street">
                                                                            <div class="wizard-form-error"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <label for="province" class="col-form-label">
                                                                            Província <span class="required">*</span></label>
                                                                        <select class="select2_single form-control wizard-required" tabindex="-1" required="required" id="province"
                                                                            name="province">
                                                                            <option value="" disabled selected>Selecionar província</option>
                                                                            @foreach ($provinces as $province )
                                                                                <option value="{{  $province->id }}">{{ $province->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                        
                                                                    <div class="col-sm-6">
                                                                        <label for="municipe" class="col-form-label">
                                                                            Município <span class="required">*</span></label>
                                                                        <select class="select2_single form-control wizard-required" tabindex="-1" id="municipe"
                                                                            name="municipe">
                                                                            <option value="" disabled selected required="required">Aguardando o campo província...</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group clearfix">
                                                                    <a href="javascript:;"
                                                                        class="form-wizard-previous-btn float-left">Anterior</a>
                                                                    <button type="submit"
                                                                        class="form-wizard-submit float-right">Enviar</button>
                                                                </div>
                                                            </fieldset>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

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

@push('js')

<script>
    jQuery(document).ready(function () {
        // click on next button
        jQuery('.form-wizard-next-btn').click(function () {
            var parentFieldset = jQuery(this).parents('.wizard-fieldset');
            var currentActiveStep = jQuery(this).parents('.form-wizard').find(
                '.form-wizard-steps .active');
            var next = jQuery(this);
            var nextWizardStep = true;
            parentFieldset.find('.wizard-required').each(function () {
                var thisValue = jQuery(this).val();

                if (thisValue == "") {
                    jQuery(this).siblings(".wizard-form-error").slideDown();
                    nextWizardStep = false;
                } else {
                    jQuery(this).siblings(".wizard-form-error").slideUp();
                }
            });
            if (nextWizardStep) {
                next.parents('.wizard-fieldset').removeClass("show", "400");
                currentActiveStep.removeClass('active').addClass('activated').next().addClass('active',
                    "400");
                next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show", "400");
                jQuery(document).find('.wizard-fieldset').each(function () {
                    if (jQuery(this).hasClass('show')) {
                        var formAtrr = jQuery(this).attr('data-tab-content');
                        jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(
                            function () {
                                if (jQuery(this).attr('data-attr') == formAtrr) {
                                    jQuery(this).addClass('active');
                                    var innerWidth = jQuery(this).innerWidth();
                                    var position = jQuery(this).position();
                                    jQuery(document).find('.form-wizard-step-move').css({
                                        "left": position.left,
                                        "width": innerWidth
                                    });
                                } else {
                                    jQuery(this).removeClass('active');
                                }
                            });
                    }
                });
            }
        });
        //click on previous button
        jQuery('.form-wizard-previous-btn').click(function () {
            var counter = parseInt(jQuery(".wizard-counter").text());;
            var prev = jQuery(this);
            var currentActiveStep = jQuery(this).parents('.form-wizard').find(
                '.form-wizard-steps .active');
            prev.parents('.wizard-fieldset').removeClass("show", "400");
            prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show", "400");
            currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active',
                "400");
            jQuery(document).find('.wizard-fieldset').each(function () {
                if (jQuery(this).hasClass('show')) {
                    var formAtrr = jQuery(this).attr('data-tab-content');
                    jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(
                        function () {
                            if (jQuery(this).attr('data-attr') == formAtrr) {
                                jQuery(this).addClass('active');
                                var innerWidth = jQuery(this).innerWidth();
                                var position = jQuery(this).position();
                                jQuery(document).find('.form-wizard-step-move').css({
                                    "left": position.left,
                                    "width": innerWidth
                                });
                            } else {
                                jQuery(this).removeClass('active');
                            }
                        });
                }
            });
        });
        //click on form submit button
        jQuery(document).on("click", ".form-wizard .form-wizard-submit", function () {
            var parentFieldset = jQuery(this).parents('.wizard-fieldset');
            var currentActiveStep = jQuery(this).parents('.form-wizard').find(
                '.form-wizard-steps .active');
            parentFieldset.find('.wizard-required').each(function () {
                var thisValue = jQuery(this).val();
                if (thisValue == "") {
                    jQuery(this).siblings(".wizard-form-error").slideDown();
                } else {
                    jQuery(this).siblings(".wizard-form-error").slideUp();
                }
            });
        });
        // focus on input field check empty or not
        jQuery(".form-control wizard-required").on('focus', function () {
            var tmpThis = jQuery(this).val();
            if (tmpThis == '') {
                jQuery(this).parent().addClass("focus-input");
            } else if (tmpThis != '') {
                jQuery(this).parent().addClass("focus-input");
            }
        }).on('blur', function () {
            var tmpThis = jQuery(this).val();
            if (tmpThis == '') {
                jQuery(this).parent().removeClass("focus-input");
                jQuery(this).siblings('.wizard-form-error').slideDown("3000");
            } else if (tmpThis != '') {
                jQuery(this).parent().addClass("focus-input");
                jQuery(this).siblings('.wizard-form-error').slideUp("3000");
            }
        });
    });

</script>
    
@endpush