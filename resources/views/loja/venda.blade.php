@extends('loja.padrao')
@section('miolo')
<div class="container">
    <div class="card">
        <div class="card-header">
           <h5 class="card-title"> Realizar Venda</h5>
        </div>
        <div class="card-body">
            <form action="{{url('finalizaVenda')}}" method="post"  onsubmit="desabilitarBotao()">
                @csrf
                <div style="margin-bottom: 10px" class="form-group">
                    <label for="">Valor</label>
                    <input id="valor" name="valor" type="text" class="form-control">
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
                    <button type="submit" id="solicitar" class="btn btn-outline-success w-100">Finalizar Pagamento</button>
                    <br>
                    <br>
                    <button class="btn btn-outline-danger w-100">Cancelar Pagamento</button>
                </div>


            </form>
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

