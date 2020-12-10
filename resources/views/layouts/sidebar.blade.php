<!DOCTYPE html>
<html>
  <head>
    <title>GéoPharma</title>

    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    />

    <!-- CSS only -->
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

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
    <link rel="stylesheet" href="{{asset('css/leaflet-routing-machine.css')}}" />


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
  
    <div class="toast" 
    data-autohide="false"
    data-delay="4000" id="myToast"
     style="position: absolute; bottom: 30px; left: 10px;z-index:99999999999999; font-size:14px; border-radius:4px">
        <div class="toast-header">
            <strong class="mr-auto"><i class="fa fa-heartbeat"></i> GéoPharma</strong>
            <small>A l'instant</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <div>
             {abc} a été ajouté à votre  
                <i class="fa fa-map"></i>
                Planning!
                
            </div>
        </div>
    </div>

        @yield('content')
   

    <div id="map"></div>
    
    <script src="{{asset('js/jquery.min.js')}} "></script>
    <script src="{{asset('js/popper.min.js')}} "></script>
    <script src="{{asset('js/bootstrap.min.js')}} "></script>
    <script src="{{asset('js/leaflet.js')}}"></script>
    <script src="{{asset('js/leaflet-sidebar.min.js')}}"></script> 
    <script src="{{asset('js/app.js')}}"></script>
      @livewireScripts
      {{-- @include('flashy::message') --}}
      @stack('scripts')
  </body>
</html>
