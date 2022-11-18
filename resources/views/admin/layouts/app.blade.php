<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SMT Labs') }}</title>
    <!-- CSS files -->
    <link href="{{ asset('adminassets/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('adminassets/css/tabler-flags.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('adminassets/css/tabler-payments.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('adminassets/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('adminassets/css/demo.min.css') }}" rel="stylesheet"/>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    @yield('style')
    @yield('stylesheet')
  </head>
  <body >
    <div class="wrapper">
            @include('admin.layouts.header')
          <div class="page-wrapper">
            @yield('content')
          </div>
    </div>

   
    <!-- Libs JS -->
    <!-- Tabler Core -->
    
    <script src="{{ asset('adminassets/js/tabler.min.js') }}"></script>
    <script src="{{ asset('adminassets/js/demo.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<script>
    $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });   
  });
</script>
    @yield('javascript')

  </body>
</html>

