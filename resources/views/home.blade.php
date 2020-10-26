@extends('layouts.sidebar')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <div id="map"></div>
    <div id="sidebar" class="leaflet-sidebar collapsed">

        <!-- nav tabs -->
        <div class="leaflet-sidebar-tabs">
            <!-- top aligned tabs -->
            <ul role="tablist">
                <li><a href="#home" role="tab"><i class="fa fa-bars active"></i></a></li>
                @auth
                    <li><a href="#plannings" role="tab"><i class="fa fa-map"></i></a></li>
                @endauth
                <li><a href="#search" role="tab"><i class="fa fa-search"></i></a></li>
            </ul>

            <!-- bottom aligned tabs -->
            <ul role="tablist">
                <li><a href="https://github.com/nickpeihl/leaflet-sidebar-v2"><i class="fa fa-github"></i></a></li>

                @guest
                <li>
                    <a href="{{route('login')}}"><i class="fa fa-user-o"></i></a>
                </li>            
                @endguest

                @auth
                    <li>
                        <a href="{{route('logout')}}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
                
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
                        <a href="{{route('drug.show',['id' => $drug->id])}}">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$drug->name}}
                            <span class="badge badge-primary badge-pill">{{$drug->labo}}</span>
                            </li>
                        </a>    
                    @empty
                        
                    @endforelse
                </ul>  
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

            <div class="leaflet-sidebar-pane" id="plannings">
                <h1 class="leaflet-sidebar-header">Mes plannings<span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
            </div>
        </div>
    </div>
     
@endsection

@push('scripts')
<script src="{{asset('js/geopharma.js')}}"></script>

<script>
    //This ---------------------------------------------------
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
