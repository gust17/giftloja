@extends('loja.padrao')
@section('miolo')
<div class="container">
    <div class="card">
        <div class="card-header">
           <h5 class="card-title"> Realizar Venda</h5>
        </div>
        <div class="card-body">
            <form action="{{url('finalizaVenda')}}" method="post">
                @csrf
                <div style="margin-bottom: 10px" class="form-group">
                    <label for="">Valor</label>
                    <input name="valor" type="text" class="form-control">
                </div>
                <div style="margin-bottom: 10px" class="form-group">
                    <label for="">CPF</label>
                    <input name="cpf" type="text" class="form-control">
                </div>
                <div style="margin-bottom: 10px" class="form-group">
                    <label for="">Token</label>
                    <input name="token" type="text" class="form-control">
                </div>

                <div style="margin-bottom: 10px" class="form-group">
                    <button class="btn btn-outline-success w-100">Finalizar Pagamento</button>
                    <br>
                    <br>
                    <button class="btn btn-outline-danger w-100">Cancelar Pagamento</button>
                </div>


            </form>
        </div>
    </div>
</div>


@endsection
