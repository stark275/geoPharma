@extends('layouts.sidebar')
@section('content') 
 <div id="sidebar" class="leaflet-sidebar collapsed">

        <!-- nav tabs -->
        <div class="leaflet-sidebar-tabs">
            <!-- top aligned tabs -->
            <ul role="tablist">
                <li><a href="#home" role="tab"><i class="fa fa-bars active"></i></a></li>
                <li><a href="#autopan" role="tab"><i class="fa fa-map"></i></a></li>
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
                    Pharmacies possedant ....
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <br/>
                <ul class="list-group">
                    @forelse ($shops as $shop)
                        <a href="#" data-lat="{{$shop->latitude}}" data-lng="{{$shop->longitude}}" class="drug">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$shop->name}}
                            <span class="badge badge-primary badge-pill">{{$shop->pivot->price.' CDF'}}</span>
                            </li>
                        </a>    
                    @empty
                         Aucune pharmacies disponible
                    @endforelse
                </ul>  
            </div>

            <div class="leaflet-sidebar-pane" id="autopan">
                <h1 class="leaflet-sidebar-header">
                    Mon Planning
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>

               

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

   var test = null;

    axios.get('{{ route('api.shops.specificaldrug',['id' => $drug->id]) }}')
    .then(function (response) {
        var test = response.data;
        console.log(test);
        
        var geojsonMarkerOptions = {
            radius: 8,
            fillColor: "#ff7800",
            color: "#000",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
        };

        L.geoJSON(response.data, {
            pointToLayer: function(geoJsonPoint, latlng) {

               // return L.marker(latlng);
                // return L.circleMarker(latlng, geojsonMarkerOptions);

                var marker = L.marker(latlng);
                marker.on('click', () => {
                    //$(marker._icon).addClass('selectedMarker');
                    let price = geoJsonPoint.properties.pivot.price + 1;
                    //console.log(response.data['features']);
                   // console.log( geoJsonPoint.properties.id);
                    let index = _.indexOf(response.data['features'],geoJsonPoint);

                });

                return marker;
            }
        })
        .bindPopup(function (layer) {
            
            return layer.feature.properties.drug_info;
        }).addTo(map);

    })
    .catch(function (error) {
        console.log(error);
    });




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
        item.addEventListener('mouseenter',function () {
            let latitude = this.dataset.lat;
            let longitude = this.dataset.lng;
            mark = L.circleMarker([latitude, longitude], geojsonMarkerOptions);
            map.addLayer(mark)

        });
         item.addEventListener('mouseleave',function () {
            map.removeLayer(mark)
        });
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

        console.log(test);


    
</script>
    
@endpush