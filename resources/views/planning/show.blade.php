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

            </ul>

            <!-- bottom aligned tabs -->
            <ul role="tablist">
                <li><a href="https://github.com/nickpeihl/leaflet-sidebar-v2"><i class="fa fa-github"></i></a></li>
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

            </div>
        </div>
    </div>


@endsection

@push('scripts')

<script src="{{asset('js/leaflet-routing-machine.min.js')}}"></script>
<script>
     var map = L.map('map').setView([
          -4.340249213281,
          15.315284729003],
          12.5
        );

        
    var geojsonMarkerOptions = {
        radius: 25,
        fillColor: "#24D238",// "#28ea3f",//"#0163FF",
        color: "#A9F6B2", //"#0163FF",
        weight: 2,
        opacity: 1,
        fillOpacity: 0.6,
        // className: 'marker-cluster'

      };

    
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
    });

    // Favorite
    
    var favorite =  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

     // OpenStreetMap
    var osmLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 18
    });
    // Wikimedia
    var mainLayer = L.tileLayer('https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}{r}.png', {
        attribution: '<a href="https://wikimediafoundation.org/wiki/Maps_Terms_of_Use">Wikimedia</a>',
        minZoom: 1,
        maxZoom: 19
    });

    var controlLayer = L.control.layers({
        'Favorite' : favorite,
        'Wikimedia': mainLayer
        
    });

    favorite.addTo(map);
    controlLayer.addTo(map);

     L.control.zoom({
        position: "topright"
    }).addTo(map);

     var sidebar = L.control
        .sidebar({ container: "sidebar", position: "right" })
        .addTo(map)
        .open("home");

    L.Routing.control({
    waypoints: [
        L.latLng(-4.300259, 15.311897),
        L.latLng(-4.349323, 15.260039),
        L.latLng(-4.339418, 15.288614)

    ]
    }).addTo(map);
</script>
    
@endpush