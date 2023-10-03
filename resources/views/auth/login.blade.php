<!doctype html>
<html lang="pt-BR" data-layout="semibox" data-sidebar-visibility="show" data-topbar="light" data-sidebar="light"
      data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8"/>
    <title>GIFTLOVES | SiteLogista</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="gifrloves sistema de apoio ao logista" name="description"/>
    <meta content="GIFTLOVES" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="assets/css/app.css" rel="stylesheet" type="text/css"/>
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css"/>

</head>

<body>

<!-- auth-page wrapper -->
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg h-100">

                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <a href="index.html" class="d-block">
                                                <img src="{{asset('logo.svg')}}" alt="" height="90">
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">
                                    <div>
                                        <h5 class="text-primary">Seja Bem Vindo!</h5>
                                        <p class="text-muted">Faça login para acessar seu painel no GiftLoves</p>
                                    </div>

                                    <div class="mt-4">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="cpf" class="form-label">CPF</label>


                                                <input id="cpf" type="cpf"
                                                       class="form-control @error('cpf') is-invalid @enderror"
                                                       name="cpf" value="{{ old('cpf') }}" required
                                                       autocomplete="cpf" placeholder="Digite seu CPF" autofocus>

                                                @error('cpf')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>


                                            <div class="mb-3">

                                                <div class="float-end">
                                                    @if (Route::has('password.request'))
                                                        <a class="text-muted" href="{{ route('password.request') }}">
                                                            Esqueceu sua senha?
                                                        </a>
                                                    @endif

                                                </div>
                                                <label for="password"
                                                       class="form-label">Senha</label>


                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" required autocomplete="current-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>


                                            <div class="mb-3">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        Manter conectado
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="row mb-0">

                                                <button type="submit" style="background-color: #23B9D6"
                                                        class="btn btn-secondary w-100">
                                                    {{ __('Login') }}
                                                </button>


                                            </div>
                                        </form>

                                    </div>


                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0">&copy;
                            <script>document.write(new Date().getFullYear())</script>
                            GiftLoves <i class="mdi mdi-heart text-danger"></i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->

<!-- JAVASCRIPT -->
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="assets/js/plugins.js"></script>

<!-- password-addon init -->
<script src="assets/js/pages/password-addon.init.js"></script>
</body>

</html>
