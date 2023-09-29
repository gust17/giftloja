@extends('loja.padrao')
@section('miolo')
    <div class="modal" id="saque">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Valor Disponivel -
                        R$ {{number_format(auth()->user()->parceira->parceira->saldoTotal(),2,',','.')}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{url('gerarsaque')}}" method="post" onsubmit="desabilitarBotao()">
                        @csrf
                        <div class="form-group">
                            <label for="">Valor</label>
                            <input id="valor" name="valor" type="text" class="form-control">
                        </div>
                        <div style="margin-top: 10px" class="form-group">
                            <button type="submit" id="solicitar" class="btn btn-success w-100">
                                Solicitar
                            </button>
                        </div>
                    </form>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                </div>

            </div>
        </div>
    </div>
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
                                <h4 class="fs-4 mb-3 text-white">
                                    <span>R$ {{number_format(auth()->user()->parceira->parceira->saldoTotal(),2,',','.')}}</span>
                                </h4>
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
                                <h4 class="fs-4 mb-3 text-white">
                                    <span>R$ {{number_format(auth()->user()->parceira->parceira->saidas(),2,',','.')}}</span>
                                </h4>
                                {{--                            <p class="text-white-50 mb-0">From 1930 last year</p>--}}
                            </div>
                            <div class="flex-shrink-0 align-self-center">
                                {{--                            <span class="badge bg-white bg-opacity-25 text-white fs-12"><i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>6.11 %<span></span></span>--}}
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div> <!-- end col-->

            @if(auth()->user()->parceira->parceira->saldoTotal() > 0)
                <div class="col-md-12">
                    <button data-bs-toggle="modal" data-bs-target="#saque" class="btn btn-info w-100">Solicitar Saque
                    </button>
                </div>

            @endif
            <!-- end col-->


        </div>
        <div style="margin-top: 15px" class="card">
            <div class="card-header">
                <h5 class="card-title"> Solicitações de Saque</h5>
            </div>


            <div class="card-body  text-center">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Responsavel</th>
                        <th>Valor Solicitado</th>
                        <th>Valor a Receber</th>
                        <th>Data da solicitação</th>
                        <th>Data limite</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($saques as $saque)
                        <tr>
                            <td>{{$saque->user->name}}</td>
                            <td>R$ {{number_format($saque->valor,2,',','.')}}</td>
                            <td>R$ {{number_format(round($saque->valor - ($saque->valor * 0.03), 2),2,',','.')}}</td>
                            <td>{{$saque->created_at->format('d/m/Y')}}</td>
                            <td>{{$saque->created_at->addDays(30)->format('d/m/Y')}}</td>
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
