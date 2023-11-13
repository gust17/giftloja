@extends('loja.padrao')
@section('miolo')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"> Consultar Usuário</h5>
        </div>


        <div class="card-body  text-center">

            <form action="{{url('user/consulta')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">
                        Digite o CPF da pessoa
                    </label>
                    <input type="text" class="form-control" name="cpf">
                </div>
                <br>
                <div class="form-group">
                    <button class="btn btn-primary">Consultar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
