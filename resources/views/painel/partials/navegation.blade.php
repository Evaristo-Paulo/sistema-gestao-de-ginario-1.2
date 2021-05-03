<!-- main content area start -->
<div class="main-content">
    <!-- header area start -->
    <div class="header-area">
        <div class="row align-items-center">
            <!-- nav and search button -->
            <div class="col-md-6 col-sm-8 clearfix">
                <div class="nav-btn pull-left">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <!-- profile info & task notification -->
            <div class="col-md-6 col-sm-4 clearfix">
                <ul class="notification-area pull-right">
                    <li class="dropdown" >
                        <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                            <span>{{ $cont_debt_clients }}</span>
                        </i>
                        <div class="dropdown-menu bell-notify-box notify-box" style="height: 170px">
                            <span class="notify-title">Alerta de cobrança</span>
                            <div class="nofity-list">
                                <a href="#" class="notify-item">
                                    <div class="notify-thumb"><i class="fa fa-calendar-times-o bg-danger" aria-hidden="true"></i></div>
                                    <div class="notify-text">
                                        <p>
                                            @if( $cont_debt_clients <= 1)
                                                Existe 1 cliente com dívida
                                            @else
                                                Existem {{ $cont_debt_clients }} clientes com dívidas
                                            @endif
                                        </p>
                                        <span class="see-debts">Ver dívidas</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
