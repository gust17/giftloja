<!doctype html>
<html lang="pt-BR" data-layout="semibox" data-sidebar-visibility="show" data-topbar="light" data-sidebar="light"
      data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8"/>
    <title>GIFTLOVES | SiteLogista</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
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
    <div class="card">
        <div class="card-header">
           <div class="card-title">SELECIONE SEU PERFIL</div>
        </div>
        <div class="card-body">
            <div>
                <div class="table-responsive table-card ">
                    <table class="table align-middle" >
                        <thead class="table-light">
                        <tr>

                            <th>Loja</th>
                            <th>Nome</th>
                            <th>Tipo Usuario</th>

                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse(auth()->user()->responsavels as $responsavel)
                            <tr>
                                <td style="display:none;"><a href="javascript:void(0);"
                                                             class="fw-medium link-primary">#VZ001</a></td>
                                <td class="name">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{env('URL_IMG').$responsavel->parceira->logo}}" alt=""
                                                 class="avatar-xs rounded-circle">
                                        </div>
                                        <div class="flex-grow-1 ms-2 name">{{$responsavel->parceira->name}}</div>
                                    </div>
                                </td>
                                <td class="company_name">{{auth()->user()->name}}</td>
                                <td class="email_id">{{$responsavel->tipo_formated}}</td>
                                <td class="phone">
                                    <a href="{{ route('dashboard.selecionar', $responsavel->id) }}" class="btn btn-primary">Entrar</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Nenhuma parceira disponível.</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>

                </div>

            </div>

            <!--end delete modal -->

        </div>
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
                           GIFTLOVES
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
