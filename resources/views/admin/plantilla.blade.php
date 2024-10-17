<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title', 'JP Consultoría')</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons-wind.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/summernote/summernote-bs4.css')}}">
  
  {{-- Sweet Alert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css')}}">
  <!-- Logo de empresa -->
  <link rel="icon" href="{{ asset('img/jpconsultoria_logo.ico') }}" type="image/x-icon">
  <!-- ficon bootstrap-->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>

@yield('css')
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="backend/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">
                @foreach (auth()->user()->roles as $role)
                {{ $role->name }}
                @endforeach
              </div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Perfil
              </a>
             {{--  <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Actividades
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Configuración
              </a> --}}
              <div class="dropdown-divider"></div>
             
              <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                @csrf
                <button class="dropdown-item has-icon text-danger logout-button"><i class="fas fa-sign-out-alt"></i>Salir</button>
                  
            </form>
            </div>

          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">JP Consultoría</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">JP</a>
          </div>
          <ul class="sidebar-menu">
            @can('Ver submenú de dashboards')
            <li class="menu-header">Dashboard</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a>
              <ul class="dropdown-menu">
                @can('Ver dashboard general')
                <li><a class="nav-link" href="#">Dashboard General </a></li>
                @endcan
                @can('Ver dashboard de asesores')
                <li><a class="nav-link" href="#">Dashboard de Asesores</a></li>
                @endcan
              </ul>
            </li>
            @endcan
            @can('Ver submenú de usuario')                          
              <li class="menu-header">Accesos</li>
              <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" ><i class="bi bi-person-gear"></i><span>Usuarios</span></a>
                
                
                <ul class="dropdown-menu">
                  @can('Ver lista de usuarios')
                  <li><a class="nav-link" href="{{route('usuarios.index')}}">Lista de usuarios</a></li>
                  @endcan 
                  @can('Crear usuarios')
                  <li><a class="nav-link" href="{{route('usuarios.create')}}">Crear nuevo usuario</a></li>
                  @endcan
                </ul>
                
                </li>


            @endcan
            
              @can('Ver submenú de roles')
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="bi bi-briefcase"></i><span>Roles</span></a>
              <ul class="dropdown-menu">
                @can('Ver lista de roles')
                <li><a class="nav-link" href="{{route('roles.index')}}">Lista de roles</a></li>
                @endcan 
                @can('Crear roles')
                <li><a class="nav-link" href="{{route('roles.create')}}">Crear nuevo rol</a></li>
                @endcan 
              </ul>
            </li>
            @endcan 
            @can('Ver submenú de asesores')
              <li class="menu-header">Administración</li>
              <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="bi bi-people"></i><span>Asesores</span></a>
                <ul class="dropdown-menu">
                  @can('Ver lista de asesores')
                  <li><a class="nav-link" href="{{route('asesores.index')}}">Lista de asesores</a></li>
                  @endcan
                </ul> 
              </li>
            @endcan
            @can('Ver submenú de clientes')
              <li class="menu-header">Clientes</li>
              <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="bi bi-person-check"></i><span>Clientes</span></a>
              <ul class="dropdown-menu">
                @can('Ver lista de clientes')
                <li><a class="nav-link" href="{{route('clientes.index')}}">Lista de Clientes</a></li>
                @endcan
              </ul>
            </li>
            @endcan
            @can('Ver submenú de clientes')
              <li class="menu-header">Proyectos</li>
              <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="bi bi-person-check"></i><span>Proyectos</span></a>
              <ul class="dropdown-menu">
                @can('Ver lista de clientes')
                <li><a class="nav-link" href="{{route('projects.index')}}">Lista de Proyectos</a></li>
                @endcan
              </ul>
            </li>
            @endcan
          {{--   @can('')
              <li class="menu-header">Espacio de trabajo</li>
              <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="bi bi-file-earmark-plus"></i><span>Proyectos</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="#">Lista de proyectos</a></li>
                  <li><a class="nav-link" href="#">Crear nuevo proyecto</a></li>
                </ul>
              </li>
            @endcan
            @can('')
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="bi bi-card-checklist"></i><span>Actividades</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="#">Lista de actividades</a></li>
                <li><a class="nav-link" href="#">Crear nueva actividad</a></li>
              </ul>
            </li>
            @endcan --}}
         </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Nuevo proyecto
            </a>
          </div>        
        
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content" style="min-height:100%">
      @yield('content')
      </div>
      
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2024 <div class="bullet"></div> Team UNT <i class="bi bi-heart"></i></a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

   
  @yield('script')

  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        var dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(function(dropdown) {
            dropdown.addEventListener('click', function() {
                this.classList.add('active');
            });
        });

        var dropdownItems = document.querySelectorAll('.dropdown-menu li');
        dropdownItems.forEach(function(item) {
            if (item.querySelector('a').textContent.trim() === 'Dashboard General') {
                item.addEventListener('click', function() {
                    this.classList.add('active');
                });
            }
        });
    });
</script>

  <!-- General JS Scripts -->
  <script src="{{ asset('backend/assets/modules/jquery.min.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/popper.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/tooltip.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/moment.min.js')}}"></script>
  <script src="{{ asset('backend/assets/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->
  <script src="{{ asset('backend/assets/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/chart.min.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>

  <!-- Page Specific JS File -->
 {{--  <script src="{{ asset('backend/assets/js/page/index-0.js')}}"></script> --}}
  
  <!-- Template JS File -->
  <script src="{{ asset('backend/assets/js/scripts.js')}}"></script>
  <script src="{{ asset('backend/assets/js/custom.js')}}"></script>
  <script>
  @yield('script')
  </script>
  @yield('js')
</body>
</html>
