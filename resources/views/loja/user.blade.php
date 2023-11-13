@extends('loja.padrao')
@section('miolo')

    <div class="container">

        <div style="margin-top: 15px" class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9"><h5 class="card-title"> Usuarios</h5></div>
                    <div class="col-md-3 float-end">
                        <a href="{{url('user/busca')}}" class="btn btn-success">Criar Usuário</a></div>
                </div>

            </div>


            <div class="card-body  text-center">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Data de criação</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($users as $user)
                        <tr>
                            <td>{{$user->user->name}}</td>
                            <td>{{$user->tipo_formated}}</td>
                            <td>{{$user->user->whatsapp}}</td>
                            <td>{{$user->user->cpf}}</td>
                            <td>{{$user->user->email}}</td>
                            <td>{{$user->created_at->format('d/m/Y')}}</td>
                            <td>
                                <a href="{{url('user/edit',$user)}}" class="btn btn-warning">Editar</a>

                                @if($user->status == 1)
                                    <a href="{{url('user/desabilitar',$user->user->id)}}" class="btn btn-danger">Desabilitar</a>
                                @else
                                    <a href="{{url('user/ativar',$user->user->id)}}" class="btn btn-success">Ativar</a>
                                @endif


                            </td>
                        </tr>
                    @empty
                    @endforelse


                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection


@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script>

        $(document).ready(function () {
            // Aplicar a máscara de CPF usando o jQuery Inputmask

            $('#valor').inputmask('currency', {
                prefix: 'R$ ',
                groupSeparator: '',
                radixPoint: ',',
                autoGroup: true,
                digits: 2,
                digitsOptional: false,
                rightAlign: false,
                allowMinus: false
            });
        });

        function desabilitarBotao() {
            // Seleciona o botão pelo ID
            var botao = document.getElementById("solicitar");

            // Desabilita o botão
            botao.disabled = true;
        }

    </script>

    <script>
        // Verifica se há uma mensagem flash com a chave 'success'
        function exibirMensagemFlash() {
            @if (session('success'))
            Swal.fire({
                title: 'Sucesso!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            @endif

            @if (session('error'))
            Swal.fire({
                title: 'Erro!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            @endif
        }

        // Chame a função quando a página for carregada
        window.addEventListener('load', exibirMensagemFlash);
    </script>


    <script>
        // Função para exibir os erros de validação do Laravel
        function exibirErrosDeValidacao(errors) {
            var mensagem = "";

            for (var campo in errors) {
                mensagem += "" + errors[campo] + "<br>";
            }

            mensagem += "";

            Swal.fire({
                title: 'Erro de Validação',
                html: mensagem,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }

        // Chame a função quando a página for carregada
        window.addEventListener('load', function () {
            @if ($errors->any())
            exibirErrosDeValidacao(@json($errors->all()));
            @endif
        });
    </script>

@endsection
