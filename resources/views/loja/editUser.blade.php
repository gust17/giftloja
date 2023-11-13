@extends('loja.padrao')
@section('miolo')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"> Edição de Usuário</h5>
        </div>


        <div class="card-body">

            <form action="{{url('user/edit')}}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="resposavel_id" value="{{$buscaResponsavels->id}}">
                <div class="form-group">
                    <label for="">
                      Nome
                    </label>
                    <input type="text" value="{{$user->name}}" class="form-control" name="name">
                </div>
                <br>
                <div class="form-group">
                    <label for="">
                        CPF
                    </label>
                    <input type="text" value="{{$user->cpf}}" class="form-control" name="cpf">
                </div>
                <br>
                <div class="form-group">
                    <label for="">
                        Whatsapp
                    </label>
                    <input type="text" value="{{$user->whatsapp}}" class="form-control" name="whatsapp">
                </div>
                <br>
                <div class="form-group">
                    <label for="">
                        Email
                    </label>
                    <input type="text" value="{{$user->email}}" class="form-control" name="email">
                </div>
                <br>

                <div class="form-group">
                    <label for="">Tipo de Usuário</label><br>
                    <div class="form-check-inline">

                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" @if($buscaResponsavels->adminstrador == 0) checked @endif  value="0" name="tipo_usuario"> Comum
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" @if($buscaResponsavels->adminstrador == 1) checked @endif value="1" name="tipo_usuario"> Administrador
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
