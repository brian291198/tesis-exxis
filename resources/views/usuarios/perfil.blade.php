@extends('admin.plantilla')
@section('title','Perfil')
@section('css')
   <!-- bootstrap -->
   {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}


<style>
  .pagination-container {
      display: flex;
      justify-content: center;
      margin-top: 20px;
  }
  .pagination {
      list-style-type: none;
      display: flex;
  }
  .pagination li {
      margin: 0 5px;
  }
  .pagination a {
      text-decoration: none;
      padding: 5px 10px;
      color: #007bff;
      border: 1px solid #dee2e6;
      border-radius: 3px;
  }
  .pagination a.active {
      background-color: #007bff;
      color: white;
  }
  .pagination a.disabled {
      color: #6c757d;
      cursor: not-allowed;
  }
</style>
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1>Perfil</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('retornarHome') }}">Home</a></div>
            <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title"> {{ $usuario['nombre'] }}</h2>
            <p class="section-lead">
            </p>

            <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                <div class="profile-widget-header">                     
                    <img alt="image" src="backend/assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name">{{ $usuario['email'] }} </div> 
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                    <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                    <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-github mr-1">
                    <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-instagram">
                    <i class="fab fa-instagram"></i>
                    </a>
                </div>
                </div>
            </div>
            </div>
          </div>
        </section>
      </div>-->
      @endsection
  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="assets/modules/summernote/summernote-bs4.js"></script>

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>