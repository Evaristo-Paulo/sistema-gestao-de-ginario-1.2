@extends('painel.template')
@section('main-title-page')
Relatório de Pagamento em Atraso -
@endsection
@section('title-page')
Relatório de Pagamento em Atraso
@endsection
@section('main-content')
<div class="row">
    <div class="col-lg-12 col-ml-12">

        <div class="row">
            <div class="col-12 mt-5">
                @if( session('create-auth') )
                            <ul class="alert alert-warning " role="alert">
                                <li><i class="fa fa-warning"></i> {{ session('create-auth') }}</li>
                            </ul>
                        @endif
                        @if( session('update-auth') )
                            <ul class="alert alert-warning " role="alert">
                                <li><i class="fa fa-warning"></i> {{ session('update-auth') }}</li>
                            </ul>
                        @endif
                        @if( session('edit-auth') )
                            <ul class="alert alert-warning " role="alert">
                                <li><i class="fa fa-warning"></i> {{ session('edit-auth') }}</li>
                            </ul>
                        @endif
                        @if( session('delete-auth') )
                            <ul class="alert alert-warning " role="alert">
                                <li><i class="fa fa-warning"></i> {{ session('delete-auth') }}</li>
                            </ul>
                        @endif
                        @if( session('warning') )
                            <ul class="alert alert-warning " role="alert">
                                <li><i class="fa fa-warning"></i> {{ session('warning') }}</li>
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
                        @if( session('password-different') )
                            <ul class="alert alert-warning " role="alert">
                                <li><i class="fa fa-warning"></i> {{ session('password-different') }}</li>
                            </ul>
                        @endif
                        @if( session('updated') )
                            <ul class="alert alert-success " role="alert">
                                <li><i class="fa fa-check"></i> {{ session('updated') }}</li>
                            </ul>
                        @endif
                        @if( session('deleted') )
                            <ul class="alert alert-success " role="alert">
                                <li><i class="fa fa-check"></i> {{ session('deleted') }}</li>
                            </ul>
                        @endif
                        @if( session('password-changed') )
                            <ul class="alert alert-success " role="alert">
                                <li><i class="fa fa-check"></i> {{ session('password-changed') }}</li>
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
                    <div class="card-body">
                        <div class="pdf tablePDF">
                            <img src="{{ url('painel/icon/pdf.png') }}" alt="">
                        </div>
                        <div class="datatable-primary table-responsive">
                            <table  class="text-center table my-table">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Qtd. Mês em Atraso</th>
                                        <th>Data do último pagamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $payments as $payment )
                                        <tr>
                                            <td>{{ $payment->name }}</td>
                                            <td>{{ $payment->debt }}</td>
                                            <td>{{  date('d/m/Y', strtotime($payment->date )) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">
                                                <p>Sem pagamentos em atraso</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endpush
@push('js')
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- others plugins -->
    <script>
        document.querySelector('.tablePDF').addEventListener('click', () => {

            // Header and footers - shows how header and footers can be drawn

            var doc = new jsPDF()
            var totalPagesExp = '{total_pages_count_string}';

            doc.autoTable({
                html: '.my-table',
                didDrawPage: function (data) {
                    // Header
                    doc.setFontSize(11)
                    doc.setTextColor(40)

                    var tableTitle = 'Relatório de Pagamento em atraso'
                    var textWidth = doc.getStringUnitWidth(tableTitle) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    var textOffset = (doc.internal.pageSize.width - textWidth)/2;
                    doc.text(textOffset, 25, tableTitle);

                    // Footer
                    var str = 'Página: ' + doc.internal.getNumberOfPages()
                    // Total page number plugin only available in jspdf v1.0+
                    if (typeof doc.putTotalPages === 'function') {
                        str = str + ' de ' + totalPagesExp
                    }
                    doc.setFontSize(10)

                    // jsPDF 1.4+ uses getWidth, <1.4 uses .width
                    var pageSize = doc.internal.pageSize
                    var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight()
		    var textWidth = doc.getStringUnitWidth(str) * doc.internal.getFontSize() / doc.internal.scaleFactor;
                    var textOffset = (doc.internal.pageSize.width - textWidth);
                    //doc.text(textOffset, 25, str, pageHeight - 10);
                    doc.text(str, textOffset, pageHeight - 10)
                },
                margin: { top: 30 },
            })

            // Total page number plugin only available in jspdf v1.0+
            if (typeof doc.putTotalPages === 'function') {
                doc.putTotalPages(totalPagesExp)
            }

            doc.save("relatorio-pagamento-em-atraso.pdf");
        });
    </script>
@endpush
