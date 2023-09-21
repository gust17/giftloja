@extends('loja.padrao')
@section('miolo')
<div class="container">
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
