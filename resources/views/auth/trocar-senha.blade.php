@extends('loja.padrao')


@section('miolo')
    <div class="container">
        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ route('salvar-nova-senha') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="senha">Nova senha:</label>
                        <input class="form-control" type="password" name="password" id="senha" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmar_senha">Confirmar nova senha:</label>
                        <input class="form-control" type="password" name="password_confirmation" id="confirmar_senha"
                               required>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success w-100" type="submit">Salvar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
