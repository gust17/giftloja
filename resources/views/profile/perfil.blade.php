@extends('loja.padrao')


@section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>

@endsection
@section('miolo')
    <style>
        .preview {
            text-align: center;
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }
    </style>

    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="assets/images/profile-bg.jpg" alt="" class="profile-wid-img">
        </div>
    </div>
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    @if(\Illuminate\Support\Facades\Auth::user()->img)
                    <img src="upload/{{\Illuminate\Support\Facades\Auth::user()->img}}" alt="user-img" class="img-thumbnail rounded-circle">
                    @else
                        <img src="{{asset('avatar.png')}}" alt="user-img" class="img-thumbnail rounded-circle">
                    @endif
                </div>
            </div>
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{\Illuminate\Support\Facades\Auth::user()->name}}</h3>

                </div>
            </div>
            <!--end col-->

            <!--end col-->

        </div>
        <!--end row-->
    </div>
    ::before
    ::before
    ::before
    ::before
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <ul class="nav nav-pills nav-justified mb-3" role="tablist">
            <li class="nav-item waves-effect waves-light" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#pill-justified-home-1" role="tab"
                   aria-selected="false" tabindex="-1">
                    Informaçao Pessoal
                </a>
            </li>

            <li class="nav-item waves-effect waves-light" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#seguranca" role="tab"
                   aria-selected="false" tabindex="-1">
                    Segurança
                </a>

            </li>

        </ul>
        <div class="tab-content text-muted">
            <div class="tab-pane active show" id="pill-justified-home-1" role="tabpanel">
                <div class="container">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Infomação</h3>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Info</h5>
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                            <tr>
                                                <th class="ps-0" scope="row">Nome Completo :</th>
                                                <td class="text-muted">{{\Illuminate\Support\Facades\Auth::user()->name}}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-0" scope="row">Celular:</th>
                                                <td class="text-muted">{{\Illuminate\Support\Facades\Auth::user()->telefone}}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-0" scope="row">E-mail :</th>
                                                <td class="text-muted">{{\Illuminate\Support\Facades\Auth::user()->email}}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <label for="">Insira sua foto</label>
                                    <input type="file" name="image" class="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="seguranca" role="tabpanel">
                <div class="container">


                    <div class="card">
                        <div class="card-header">
                            <h5>ALTERAR MINHA SENHA</h5>
                        </div>
                        <div class="card-body">



                            <form action="{{url('conta/novasenha')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Senha Atual</label>
                                    <input type="password" class="form-control" name="current_password" placeholder="Senha Atual" required>
                                </div>
                                <div class="form-group">
                                    <label>Nova Senha</label>
                                    <input type="password" class="form-control" name="new_password" placeholder="Nova Senha" required>
                                </div>
                                <div class="form-group">
                                    <label>Confirmar Nova Senha</label>
                                    <input type="password" class="form-control" name="new_confirm_password" placeholder="Confirmar Nova Senha" required>
                                </div>
                                <br>
                                <br>
                                <br>
                                <button type="submit" name="submit" value="Atualizar" class="btn btn-success btn-block">ALTERAR MINHA SENHA</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>
    </div>




    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Ajuste sua Imagem</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img class="img-fluid" id="image"
                                     src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="crop">Concluir</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

    <script>
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;

        $("body").on("change", ".image", function (e) {
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                $modal.modal('show');
            };

            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function () {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });

            var user = {{\Illuminate\Support\Facades\Auth::user()->id}};

            console.log(user);
            canvas.toBlob(function (blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "api/uploaduser",
                        data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data, 'user': user},
                        success: function (data) {
                            console.log(data);
                            $modal.modal('hide');
                            location.reload(true);
                        }
                    });
                }
            });
        });
    </script>



@endsection
