<!DOCTYPE html>
<html>
  <head>
    <title>GéoPharma</title>

    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    />

    <!-- CSS only -->
<link rel="stylesheet"
  href="{{asset('css/bootstrap.min.css')}}" 
>

    <link
      href="{{asset('css/font-awesome.min.css')}}"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="{{asset('css/leaflet.css')}}"
      crossorigin=""
    />

    <link rel="stylesheet" href="{{asset('css/leaflet-sidebar.min.css')}}" />

    <style>
      body {
        padding: 0;
        margin: 0;
      }

      html,
      body,
      #map {
        height: 100%;
        font: 10pt "Helvetica Neue", Arial, Helvetica, sans-serif;
      }

      .lorem {
        font-style: italic;
        color: #aaa;
      }
    </style>
        @livewireStyles
  </head>
  <body>
   
        @yield('content')
   

    <div id="map"></div>
    
    <script
      src="{{asset('js/leaflet.js')}}"
      crossorigin=""
    ></script>
    <script src="{{asset('js/leaflet-sidebar.min.js')}}"></script> 
    <script src="{{asset('js/app.js')}}"></script>
    @stack('scripts')
        @livewireScripts
  </body>
</html>
