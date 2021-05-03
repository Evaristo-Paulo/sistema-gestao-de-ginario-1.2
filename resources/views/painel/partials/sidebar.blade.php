<div class="sidebar-menu">
    <div class="sidebar-header">
        <a href="{{ route('home') }}">
            <h2 class="logo-title">Sistema de Gestão</h2>
        </a>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li><a href="{{ route('home') }}"><i class="fa fa-home" aria-hidden="true"></i>
                            <span>Home</span></a></li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-child" aria-hidden="true"></i>
                            <span>Cliente</span></a>
                        <ul class="collapse">
                            @can('create')
                                <li><a href="{{ route('client.register.form') }}">Registo</a></li>
                            @endcan
                            <li><a href="{{ route('client.list') }}">Listagem</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-users" aria-hidden="true"></i>
                            <span>Funcionário</span></a>
                        <ul class="collapse">
                            @can('create')
                                <li><a href="{{ route('worker.register') }}">Registo</a></li>
                            @endcan
                            <li><a href="{{ route('worker.list') }}">Listagem</a></li>
                            @can('create')
                                <li><a href="#" data-toggle="modal" data-target="#worker-modal-altera-foto">Alterar Foto
                                        de Perfil</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-money" aria-hidden="true"></i>
                            <span>Pagamento</span></a>
                        <ul class="collapse">
                            @can('create')
                            <li><a href="{{ route('payment.register.form') }}">Registo</a></li>
                            @endcan
                            <li><a href="{{ route('payment.list') }}">Listagem</a></li>
                            <li><a href="">Histórico</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-file-text-o"
                                aria-hidden="true"></i>
                            <span>Relatório</span></a>
                        <ul class="collapse">
                            <li><a href="{{ route('payment.relatory.year') }}">Pagamento anual</a></li>
                            <li><a href="{{ route('historic.list') }}">Pagamento mensal</a></li>
                            <li><a href="{{ route('payment.relatory.debt') }}">Pagamento em atraso</a></li>
                            <li><a href="{{ route('payment.relatory.paid') }}">Pagamento regularizado</a></li>
                        </ul>
                    </li>
                    @can('create')
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-cogs" aria-hidden="true"></i>
                            <span>Controle de Acesso</span></a>
                        <ul class="collapse">
                            <li><a href="#" aria-expanded="true">User</a>
                                <ul class="collapse">
                                    <li><a href="{{ route('user.register.form') }}">Registo</a></li>
                                    <li><a href="{{ route('user.list') }}">Listagem</a></li>
                                    <li data-toggle="modal" data-target="#user-modal-altera-senha"><a href="#">Alterar
                                            Senha</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @endcan

                </ul>
            </nav>
        </div>
    </div>
</div>
