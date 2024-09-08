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
    @yield('scripts')
</body>
</html>