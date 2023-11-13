@extends('loja.padrao')
@section('miolo')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"> Novo Usuário</h5>
        </div>


        <div class="card-body">

            <form action="{{url('user/newUser')}}" method="post">
                @csrf

                <div class="form-group">
                    <label for="">
                      Nome
                    </label>
                    <input type="text" class="form-control" name="name">
                </div>
                <br>
                <div class="form-group">
                    <label for="">
                        CPF
                    </label>
                    <input type="text" value="{{$cpf}}" class="form-control" name="cpf">
                </div>
                <br>
                <div class="form-group">
                    <label for="">
                        Whatsapp
                    </label>
                    <input type="text" value="" class="form-control" name="whatsapp">
                </div>
                <br>
                <div class="form-group">
                    <label for="">
                        Email
                    </label>
                    <input type="text" value="" class="form-control" name="email">
                </div>
                <br>

                <div class="form-group">
                    <label for="">Tipo de Usuário</label><br>
                    <div class="form-check-inline">

                        <label class="form-check-label">
                            <input type="radio" class="form-check-input"   value="0" name="tipo_usuario"> Comum
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input"  value="1" name="tipo_usuario"> Administrador
                        </label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <button class="btn btn-success">Salvar</button>
                </div>

            </form>
        </div>
    </div>
@endsection
