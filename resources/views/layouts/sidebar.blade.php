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
  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
  integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
  crossorigin="anonymous"
>

    <link
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
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
  </head>
  <body>
    @yield('content')
    <div id="map"></div>

    <script
      src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
      crossorigin=""
    ></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/leaflet-sidebar.min.js')}}"></script> 
    @stack('scripts')
  </body>
</html>
