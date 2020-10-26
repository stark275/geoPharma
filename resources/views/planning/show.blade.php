@extends('layouts.sidebar')

@section('content')
    <style>
    .badge{
        font-size: 12px;
    }
</style>
 <div id="sidebar" class="leaflet-sidebar collapsed">

        <!-- nav tabs -->
        <div class="leaflet-sidebar-tabs">
            <!-- top aligned tabs -->
            <ul role="tablist">
                <li><a href="#home" role="tab"><i class="fa fa-map active"></i></a></li>
                <li><a href="#search" role="tab"><i class="fa fa-search"></i></a></li>
                <li><a onclick="hideItinerary()"  ><i class="fa fa-map-signs"></i></a></li>


            </ul>
            <!-- bottom aligned tabs -->
            <ul role="tablist">
                <li><a href="{{route('home')}}"><i class="fa fa-home"></i></a></li>
            </ul>
        </div>

        <!-- panel content -->
        <div class="leaflet-sidebar-content">
            <div class="leaflet-sidebar-pane" id="home">
                <h1 class="leaflet-sidebar-header">
                    Planning
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <br/>
                @livewire('newplanning')  
            </div>

 
            <div class="leaflet-sidebar-pane" id="search">
                
                <h1 class="leaflet-sidebar-header">
                    Trouver un Medicament
                    <span class="leaflet-sidebar-close">
                        <i class="fa fa-caret-left"></i>
                    </span>
                </h1>

                @livewire('search')

                 <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                    
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        @if (Route::has('register'))
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        @endif
                                    </li>
                                @else
                                    
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>

            </div>
        </div>
    </div>


@endsection

@push('scripts')

<script src="{{asset('js/leaflet-routing-machine.min.js')}}"></script>
<script src="{{asset('js/geopharma.js')}}"></script>

<script>
        
    var geojsonMarkerOptions = {
        radius: 25,
        fillColor: "#24D238",// "#28ea3f",//"#0163FF",
        color: "#A9F6B2", //"#0163FF",
        weight: 2,
        opacity: 1,
        fillOpacity: 0.6,
        // className: 'marker-cluster'

      };

    var waypoints = []
    
    Array.from(document.querySelectorAll(".drug")).forEach((item) => {
        var mark;
        var latitude = item.dataset.lat;
        var longitude = item.dataset.lng;

        item.addEventListener('mouseenter',function () {
            
            mark = L.circleMarker([latitude, longitude], geojsonMarkerOptions);
            map.addLayer(mark)
            //console.log(this.dataset)

        });
         item.addEventListener('mouseleave',function () {
            map.removeLayer(mark)
        });

         var marker = L.marker([latitude, longitude])
         marker.addTo(map)

        waypoints.push(L.latLng(latitude, longitude))
    });

    // Routing machine
    L.Routing.control({
    waypoints:waypoints,
    language: 'fr'
    }).addTo(map);

    var itPannel = document.querySelector('.leaflet-routing-container')
    
    function hideItinerary() {
        if (itPannel.style.display === "none") {
            itPannel.style.display = "block";
        } else {
            itPannel.style.display = "none";
        }
    }
</script>
    
@endpush