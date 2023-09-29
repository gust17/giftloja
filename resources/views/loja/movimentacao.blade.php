@extends('loja.padrao')
@section('miolo')
<div class="container">
    <div class="row">
        <div class="col-xl-6 col-md-6">
            <div class="card bg-success card-height-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-white bg-opacity-25 text-white rounded-2 fs-2">
                                                <i class="bx bx-shopping-bag"></i>
                                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-uppercase fw-medium text-white-50 mb-3">Em caixa</p>
                            <h4 class="fs-4 mb-3 text-white"><span>R$ {{number_format(auth()->user()->parceira->parceira->saldoTotal(),2,',','.')}}</span></h4>
{{--                            <p class="text-white-50 mb-0">From 1930 last year</p>--}}
                        </div>
                        <div class="flex-shrink-0 align-self-center">
{{--                            <span class="badge bg-white bg-opacity-25 text-white fs-12"><i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>6.11 %<span></span></span>--}}
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div> <!-- end col-->
        <div class="col-xl-6 col-md-6">
            <div class="card bg-danger card-height-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-white bg-opacity-25 text-white rounded-2 fs-2">
                                                <i class="bx bx-money-withdraw"></i>
                                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-uppercase fw-medium text-white-50 mb-3">Saques</p>
                            <h4 class="fs-4 mb-3 text-white"><span>R$ {{number_format(auth()->user()->parceira->parceira->saidas(),2,',','.')}}</span></h4>
{{--                            <p class="text-white-50 mb-0">From 1930 last year</p>--}}
                        </div>
                        <div class="flex-shrink-0 align-self-center">
{{--                            <span class="badge bg-white bg-opacity-25 text-white fs-12"><i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>6.11 %<span></span></span>--}}
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div> <!-- end col-->

        <!-- end col-->


    </div>
    <div class="card">
        <div class="card-header">
           <h5 class="card-title"> Movimentações</h5>
        </div>



        <div class="card-body  text-center">
            <div class="table-responsive">
                <table id="myTable" class="table ">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descriçao</th>
                        <th>Value</th>
                        <th>tipo</th>
                        <th>data</th>
                    </tr>
                    </thead>
                    <tbody>


                    @forelse(auth()->user()->parceira->parceira->extratos as $movimento)
                        <tr class="@if($movimento->tipo === 2) text-danger @else text-success @endif">
                            <td>{{ $movimento->id }}</td>
                            <td>{{ $movimento->descricao }}</td>
                            <td>R$ {{ number_format($movimento->valor, 2, ',', '.') }}</td>
                            <td>{{ $movimento->status_formated }}</td>
                            <td>{{ $movimento->created_at->format('d-m-y') }}</td>
                        </tr>
                    @empty

                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


@endsection
