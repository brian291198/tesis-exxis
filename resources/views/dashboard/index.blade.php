@extends('admin.plantilla')
@section('title','Dashboard')

@section('content')

<div class="section" style="overflow-x: hidden;">


{{--   INICIO DE CONTENIDO --}}
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>
  <div class="row">
    
 {{--  COLUMNA 1 GENERAL --}}
<div class="col-lg-8 col-md-12">
    <div class="row">
    
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 p-2">
      <div class="card card-statistic-1">
        <div class="btn-primary card-icon">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Clientes</h4>
          </div>
          <div class="card-body">
            {{$totalClientes}}
          </div>
        </div>
      </div>
    </div>


    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon btn-primary">
          <i class="fas fa-map-marker-alt"></i>

        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Áreas</h4>
          </div>
          <div class="card-body">
            {{$totalAreas}}
          </div>
        </div>
      </div>
    </div>


    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon btn-primary">
          <i class="fas fa-file-invoice"></i>

        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Facturas</h4>
          </div>
          <div class="card-body">
            {{$totalFacturas}}
          </div>
        </div>
      </div>
    </div>



    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon btn-primary">
          <i class="fas fa-money-bill-wave"></i>

        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Cuotas</h4>
          </div>
          <div class="card-body">
            {{$totalPeriodos}}
          </div>
        </div>
      </div>
    </div> 
    
    
  </div>



  <div class="row">

    <div class="col-12">
      <div class="card">
        <div class="card-body pt-2 pb-2 ">
          <div class="row">
            <div class="col-md-6 col-sm-12 d-flex justify-content-sm-center justify-content-md-start align-items-center  my-2">
              <div id="myWeather">Comparación entre 2 periodos (agregar filtros de año y mes)</div>
            </div>
          
            <div class="col-md-6 col-sm-12 d-flex justify-content-sm-center justify-content-md-end align-items-center  my-2">
              <button class="btn btn-primary">
                <i class="fas fa-exchange-alt mr-2"></i>Comparar
              </button>
            </div>
          </div>
          
          
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-stats mt-3">
          <div class="card-stats-items">
            <div class="card-stats-item">
              <div class="card-stats-item-count">24</div>
              <div class="card-stats-item-label">Cumplimiento</div>
            </div>
            <div class="card-stats-item">
              <div class="card-stats-item-count">12</div>
              <div class="card-stats-item-label">Pagado</div>
            </div>
            <div class="card-stats-item">
              <div class="card-stats-item-count">23</div>
              <div class="card-stats-item-label">Mora</div>
            </div>
            <div class="card-stats-item">
              <div class="card-stats-item-count">23</div>
              <div class="card-stats-item-label">Incobrable</div>
            </div>
          </div>
        </div>
        <div class="card-icon shadow-primary" style="background-color: #42BC5F">
          <i class="fas fa-archive"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Recaudado</h4>
          </div>
          <div class="card-body">
            59
          </div>
        </div>
        
      </div>
    </div>


    <div class="col-md-6 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-stats mt-3">
          <div class="card-stats-items">
            <div class="card-stats-item">
              <div class="card-stats-item-count">24</div>
              <div class="card-stats-item-label">Cumplimiento</div>
            </div>
            <div class="card-stats-item">
              <div class="card-stats-item-count">12</div>
              <div class="card-stats-item-label">Pagado</div>
            </div>
            <div class="card-stats-item">
              <div class="card-stats-item-count">23</div>
              <div class="card-stats-item-label">Mora</div>
            </div>
            <div class="card-stats-item">
              <div class="card-stats-item-count">23</div>
              <div class="card-stats-item-label">Incobrable</div>
            </div>
          </div>
        </div>
        <div class="card-icon shadow-primary" style="background-color: #0E6F90">
          <i class="fas fa-archive"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Recaudado</h4>
          </div>
          <div class="card-body">
            59
          </div>
        </div>
      </div>
    </div>


  </div>

  <div class="row">

    <div class="col-12">
      <div class="card">
        <div class="card-body pt-2 pb-2 ">
          <div class="row">
            <div class="col-md-6 col-sm-12 d-flex justify-content-sm-center justify-content-md-start align-items-center  my-2">
              <div id="myWeather">Gráficos Estadísticos</div>
            </div>
          
            <div class="col-md-6 col-sm-12 d-flex justify-content-sm-center justify-content-md-end align-items-center  my-2">
              <button class="btn btn-primary">
                <i class="fas fa-chart-bar mr-2"></i>Actualizar Gráficos
              </button>
            </div>
          </div>
          
          
        </div>
      </div>
    </div>
  </div>

  {{-- FILA 4 --}}
    <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          
            <div class="col-md-6 col-sm-12 d-flex justify-content-sm-center justify-content-md-start align-items-center  my-2">
              <div id="myWeather"><Recaudación total por Mes (agregar filtro de año para obtener gráfica)</div>
            </div>



        </div>
        <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <canvas id="myChart2" width="507" height="253" style="display: block; width: 507px; height: 253px;" class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>
    </div>

    <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Bar Chart</h4>
          </div>
          <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
            <canvas id="myChart2" width="507" height="253" style="display: block; width: 507px; height: 253px;" class="chartjs-render-monitor"></canvas>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Bar Chart</h4>
          </div>
          <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
            <canvas id="myChart2" width="507" height="253" style="display: block; width: 507px; height: 253px;" class="chartjs-render-monitor"></canvas>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>

 {{--  COLUMNA 2 GENERAL --}}
<div class="col-lg-4 col-md-12">

    <div class="card">
      <div class="card-header">
        <h4>Comentarios Recientes</h4>
      </div>
      <div class="card-body">             
        <ul class="list-unstyled list-unstyled-border">
          <li class="media">
            <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-1.png" alt="avatar">
            <div class="media-body">
              <div class="float-right text-primary">Now</div>
              <div class="media-title">Farhan A Mujib</div>
              <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
            </div>
          </li>
          <li class="media">
            <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-2.png" alt="avatar">
            <div class="media-body">
              <div class="float-right">12m</div>
              <div class="media-title">Ujang Maman</div>
              <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
            </div>
          </li>
          <li class="media">
            <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-3.png" alt="avatar">
            <div class="media-body">
              <div class="float-right">17m</div>
              <div class="media-title">Rizal Fakhri</div>
              <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
            </div>
          </li>
          <li class="media">
            <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-4.png" alt="avatar">
            <div class="media-body">
              <div class="float-right">21m</div>
              <div class="media-title">Alfa Zulkarnain</div>
              <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
            </div>
          </li>
        </ul>
        <div class="text-center pt-1 pb-1">
          <a href="#" class="btn btn-primary btn-lg btn-round">
            View All
          </a>
        </div>
      </div>
    </div>


</div>
</div>
</div>



@endsection
@section('js')

  <!-- JS Libraies -->
  <script src="assets/modules/chart.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/modules-chartjs.js"></script>
  @endsection