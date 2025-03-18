<!DOCTYPE html>
@php
$user = auth()->user();
if($user->imagem){
    $avatar = "/public/img/users/".$user->imagem;
}
else{
    if($user->ds_genero == "Masculino"){
        $avatar = "/public/template/img/avatars/1.png";
    }
    else{
        $avatar = "/public/template/img/avatars/2.png";
    }
}
if($user->tp_usuario == 'Administrador'){
    $ministerios = App\Models\Ministerio::where('st_reuniao', 'Sim')->get();
}
else{
    $ministerios = $user->ministerios()->where('st_reuniao', 'Sim')->get();
}

//vamos verificar se o usuario tem direito a acessar as Atividades
$controle_atividades = false;
foreach($user->ministerios as $ministerio){
    if($ministerio->st_reuniao == "Sim"){
        $controle_atividades = true;
    }
}
@endphp
<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/public/template/"
  data-template="horizontal-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Geração Vida - Área Administrativa</title>

    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/public/img/logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/fonts/materialdesignicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/fonts/flag-icons.css') }}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/libs/node-waves/node-waves.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/public/template/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/libs/swiper/swiper.css') }}" />

    <link rel="stylesheet" href="{{ asset('/public/template/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />

    <link rel="stylesheet" href="{{ asset('/public/template/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/css/pages/cards-statistics.css') }}" />
    <link rel="stylesheet" href="{{ asset('/public/template/vendor/css/pages/cards-analytics.css') }}" />

    <link href='/public/plugins/fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='/public/plugins/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
    <link href='/public/plugins/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
    <link href='/public/plugins/fullcalendar/packages/list/main.css' rel='stylesheet' />

    <!-- Helpers -->
    <script src="{{ asset('/public/template/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('/public/template/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/public/template/js/config.js') }}"></script>

    <script src='/public/plugins/fullcalendar/packages/core/main.js'></script>
    <script src='/public/plugins/fullcalendar/packages/interaction/main.js'></script>
    <script src='/public/plugins/fullcalendar/packages/daygrid/main.js'></script>
    <script src='/public/plugins/fullcalendar/packages/timegrid/main.js'></script>
    <script src='/public/plugins/fullcalendar/packages/list/main.js'></script>
    <script src='/public/plugins/fullcalendar/packages/core/locales/pt-br.js'></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
      <div class="layout-container">
        <!-- Navbar -->

        <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="container-xxl">
            <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
              <a href="{{route('dashboard')}}" class="app-brand-link gap-2">
                <img src="{{ asset('/public/img/logo.png') }}" height="60px" alt="">
              </a>
              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                <i class="mdi mdi-close align-middle"></i>
              </a>
            </div>
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="mdi mdi-menu mdi-24px"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Style Switcher -->
                <li class="nav-item dropdown-style-switcher dropdown me-1 me-xl-0">
                  <a
                    class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <i class="mdi mdi-24px"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                        <span class="align-middle"><i class="mdi mdi-weather-sunny me-2"></i>Light</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                        <span class="align-middle"><i class="mdi mdi-weather-night me-2"></i>Dark</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                        <span class="align-middle"><i class="mdi mdi-monitor me-2"></i>System</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- / Style Switcher-->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset($avatar) }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{ asset($avatar) }}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-medium d-block">{{ $user->nm_usuario }}</span>
                            <small class="text-muted">{{ $user->tp_usuario }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('perfil') }}">
                        <i class="mdi mdi-account-outline me-2"></i>
                        <span class="align-middle">Perfil</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('alterar_senha') }}">
                        <i class="mdi mdi-cog-outline me-2"></i>
                        <span class="align-middle">Alterar Senha</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="mdi mdi-logout me-2"></i>
                        <span class="align-middle">Sair</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
              <div class="container-xxl d-flex h-100">
                <ul class="menu-inner">
                  <!-- Dashboards -->
                  <li class="menu-item active">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                      <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                      <div data-i18n="Dashboard">Dashboard</div>
                    </a>
                  </li>
                  <!-- Layouts -->
                  @if($user->tp_usuario == "Administrador")
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons mdi mdi-cog-outline"></i>
                          <div data-i18n="Cadastros">Cadastros</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="{{ route('ministerios') }}" class="menu-link">
                              <i class="menu-icon tf-icons mdi mdi-format-list-group"></i>
                              <div data-i18n="Ministérios">Ministérios</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="{{ route('usuarios') }}" class="menu-link">
                              <i class="menu-icon tf-icons mdi mdi-account"></i>
                              <div data-i18n="Usuários">Usuários</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                  @endif
                  @if($user->tp_usuario == "Administrador" || $user->tp_usuario == 'Secretaria' || $user->tp_usuario == "Boas Vindas" || $user->tp_usuario == "Líder Cultos")
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons mdi mdi-face-agent"></i>
                          <div data-i18n="Secretaria">Secretaria</div>
                        </a>
                        <ul class="menu-sub">
                          @if($user->tp_usuario == "Administrador" || $user->tp_usuario == 'Secretaria' || $user->tp_usuario == "Boas Vindas")
                              <li class="menu-item">
                                <a href="{{ route('membros') }}" class="menu-link">
                                  <i class="menu-icon tf-icons mdi mdi-account-multiple-check"></i>
                                  <div data-i18n="Membros">Membros</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="{{ route('visitas_frequentes') }}" class="menu-link">
                                  <i class="menu-icon tf-icons mdi mdi-account-sync"></i>
                                  <div data-i18n="Visitantes Frequentes">Visitantes Frequentes</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="{{ route('primeiras_visitas') }}" class="menu-link">
                                  <i class="menu-icon tf-icons mdi mdi-account-question"></i>
                                  <div data-i18n="Primeiras Visitas">Primeiras Visitas</div>
                                </a>
                              </li>
                          @endif
                          @if($user->tp_usuario == "Administrador" || $user->tp_usuario == 'Secretaria' || $user->tp_usuario == "Líder Cultos")
                              <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                  <i class="menu-icon tf-icons mdi mdi-human-capacity-increase"></i>
                                  <div data-i18n="Cultos">Cultos</div>
                                </a>
                                <ul class="menu-sub">
                                  <li class="menu-item">
                                    <a href="{{ route('cultos', 'Culto') }}" class="menu-link">
                                      <i class="menu-icon tf-icons mdi mdi-arrow-right-bottom-bold mdi-20px"></i>
                                      <div data-i18n="Culto">Culto</div>
                                    </a>
                                  </li>
                                  <li class="menu-item">
                                    <a href="{{ route('cultos', 'Escola de Servos') }}" class="menu-link">
                                      <i class="menu-icon tf-icons mdi mdi-arrow-right-bottom-bold mdi-20px"></i>
                                      <div data-i18n="Escola de Servos">Escola de Servos</div>
                                    </a>
                                  </li>
                                  <li class="menu-item">
                                    <a href="{{ route('cultos', 'Oração') }}" class="menu-link">
                                      <i class="menu-icon tf-icons mdi mdi-arrow-right-bottom-bold mdi-20px"></i>
                                      <div data-i18n="Oração">Oração</div>
                                    </a>
                                  </li>
                                  <li class="menu-item">
                                    <a href="{{ route('cultos', 'Ceia') }}" class="menu-link">
                                      <i class="menu-icon tf-icons mdi mdi-arrow-right-bottom-bold mdi-20px"></i>
                                      <div data-i18n="Ceia">Ceia</div>
                                    </a>
                                  </li>
                                  <li class="menu-item">
                                    <a href="{{ route('cultos', 'Culto Infantil') }}" class="menu-link">
                                      <i class="menu-icon tf-icons mdi mdi-arrow-right-bottom-bold mdi-20px"></i>
                                      <div data-i18n="Culto Infantil">Culto Infantil</div>
                                    </a>
                                  </li>
                                </ul>
                              </li>
                          @endif
                          @if($user->tp_usuario == "Administrador" || $user->tp_usuario == 'Secretaria')
                              <li class="menu-item">
                                <a href="{{ route('secretaria.visitas') }}" class="menu-link">
                                  <i class="menu-icon tf-icons mdi mdi-car-clock"></i>
                                  <div data-i18n="Visitas">Visitas</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="{{ route('secretaria.atendimentos') }}" class="menu-link">
                                  <i class="menu-icon tf-icons mdi mdi-clipboard-text-clock-outline"></i>
                                  <div data-i18n="Atendimentos">Atendimentos</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="{{ route('secretaria.atividades') }}" class="menu-link">
                                  <i class="menu-icon tf-icons mdi mdi-gesture-tap-button"></i>
                                  <div data-i18n="Atividades">Atividades</div>
                                </a>
                              </li>
                          @endif
                        </ul>
                      </li>
                  @endif
                  <li class="menu-item">
                    <a href="{{ route('contatos') }}" class="menu-link">
                      <i class="menu-icon tf-icons mdi mdi-card-account-phone-outline"></i>
                      <div data-i18n="Contatos">Contatos</div>
                    </a>
                  </li>
                  @if($user->tp_usuario == "Administrador" || $user->st_atendimento == "Sim")
                      <li class="menu-item">
                        <a href="{{ route('agendas') }}" class="menu-link">
                          <i class="menu-icon tf-icons mdi mdi-clipboard-text-clock-outline"></i>
                          <div data-i18n="Atendimentos">Atendimentos</div>
                        </a>
                      </li>
                  @endif
                  @if($user->tp_usuario == "Administrador" || $user->tp_usuario == "Líder Visítas")
                      <li class="menu-item">
                        <a href="{{ route('visitas') }}" class="menu-link">
                          <i class="menu-icon tf-icons mdi mdi-car-clock"></i>
                          <div data-i18n="Visitas">Visitas</div>
                        </a>
                      </li>
                  @endif
                  @if($controle_atividades || $user->tp_usuario == "Administrador")
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons mdi mdi-gesture-tap-button"></i>
                          <div data-i18n="Atividades">Atividades</div>
                        </a>
                        <ul class="menu-sub">
                            @foreach($ministerios as $ministerio)
                                <li class="menu-item">
                                  <a href="{{ route('reunioes', $ministerio->id) }}" class="menu-link">
                                    <i class="menu-icon tf-icons mdi mdi-format-list-group"></i>
                                    <div data-i18n="{{ $ministerio->nm_ministerio }}">{{ $ministerio->nm_ministerio }}</div>
                                  </a>
                                </li>
                            @endforeach
                        </ul>
                      </li>
                  @endif
                </ul>
              </div>
            </aside>
            <!-- / Menu -->

            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                @yield('conteudo')
            </div>
            <!--/ Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
                  <div class="mb-2 mb-md-0">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , Desenvolvido por Webpel Soluções Digitais
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->
            <div class="content-backdrop fade"></div>
          </div>
          <!--/ Content wrapper -->
        </div>
        <!--/ Layout container -->
      </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!--/ Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('/public/template/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/public/template/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/public/template/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('/public/template/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/public/template/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('/public/template/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('/public/template/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('/public/template/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('/public/template/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('/public/template/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('/public/template/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('/public/template/js/main.js') }}"></script>

    <!-- Demais arquivos -->
    <script src="{{ asset('/public/js/script.js') }}"></script>
  </body>
</html>
