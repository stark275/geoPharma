@extends('layouts.sidebar',['drug' => $drugs])
@section('content') 
    <div id="sidebar" class="leaflet-sidebar collapsed">

        <!-- nav tabs -->
        <div class="leaflet-sidebar-tabs">
            <!-- top aligned tabs -->
            <ul role="tablist">
                <li><a href="#home" role="tab"><i class="fa fa-bars active"></i></a></li>
                <li><a href="#autopan" role="tab"><i class="fa fa-arrows"></i></a></li>
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
                    Liste de Médicaments
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <br/>
                <ul class="list-group">
                    @forelse ($drugs as $drug)
                        <a href="#">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$drug->name}}
                            <span class="badge badge-primary badge-pill">{{$drug->labo}}</span>
                            </li>
                        </a>    
                    @empty
                        
                    @endforelse
                </ul>  
            </div>

            <div class="leaflet-sidebar-pane" id="autopan">
                <h1 class="leaflet-sidebar-header">
                    autopan
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <p>
                    <code>Leaflet.control.sidebar({ autopan: true })</code>
                    makes shure that the map center always stays visible.
                </p>
                <p>
                    The autopan behviour is responsive as well.
                    Try opening and closing the sidebar from this pane!
                </p>
            </div>

            <div class="leaflet-sidebar-pane" id="messages">
                <h1 class="leaflet-sidebar-header">Messages<span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script>
      var map = L.map('map').setView([
          -4.340249213281,
          15.315284729003],
          12.5
        );
    var baseUrl = "{{ url('/') }}";

    axios.get('{{ route('api.shops.index') }}')
    .then(function (response) {
        console.log(response.data);

        L.geoJSON(response.data, {
            pointToLayer: function(geoJsonPoint, latlng) {

                return L.marker(latlng);
            }
        })
        .bindPopup(function (layer) {
            
            return layer.feature.properties.map_popup_content;
        }).addTo(map);

    })
    .catch(function (error) {
        console.log(error);
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

    var theMarker;

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);

        if (theMarker != undefined) {
            map.removeLayer(theMarker);
        };

        var popupContent = "Coordonnées : " + latitude + ", " + longitude + ".";
        popupContent += '<br><a href="localhost?latitude=' + latitude + '&longitude=' + longitude + '">Générer l\'itinéire</a>';

        theMarker = L.marker([latitude, longitude]).addTo(map);
        theMarker.bindPopup(popupContent)
        .openPopup();
    });
</script>
    
@endpush