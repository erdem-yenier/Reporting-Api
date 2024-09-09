<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    @yield('css')
    <title>Document</title>
</head>
<body>
    @include('dashboard.partials.navbar')
    <div class="container-fluid">
      <div class="row">
        @include('dashboard.partials.aside')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          
          @yield('content')
        
        </main>
      </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
          }
      });
    </script>
    @yield('scripts')
</body>
</html>