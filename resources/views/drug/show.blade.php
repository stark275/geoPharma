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
                <li><a href="#home" role="tab"><i class="fa fa-bars active"></i></a></li>
                <li><a href="#autopan" role="tab"><i class="fa fa-map"></i></a></li>
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
                    Pharmacies possedant ....
                    <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <br/>
                <ul class="list-group">
                    @forelse ($shops as $shop)
                        <a href="#" data-lat="{{$shop->latitude}}" data-lng="{{$shop->longitude}}" class="drug">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$shop->name}}
                            <span class="badge badge-primary badge-pill">{{number_format($shop->pivot->price, 2, ',', ' ').' CDF'}}</span>
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
<script src="{{asset('js/geopharma.js')}}"></script>
<script>
    

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
            //console.log(this.dataset)

        });
         item.addEventListener('mouseleave',function () {
            map.removeLayer(mark)
        });
    });

    document.addEventListener('click',function(e){
        if(e.target && e.target.id== 'addfeature'){

           let feature = this.querySelector('#addfeature').dataset.featureId
           let planning = this.querySelector('#planning-id').dataset.planningId


           // todo: Generate path dynamically
           axios.post('http://localhost:8000/planning/feature/add',{
               id : feature,
               planningId : planning
            })
           .then(function (response) {
               console.log(response)

               if (response.data == 1) {
                   console.log('you must be connected') 
                   window.livewire.emit('featureAdded',response)

               }else{
                   window.livewire.emit('featureAdded',response)
               }

           })
           .catch(function (error) {
               console.log(error)
           })
        }
    });

    window.livewire.on('featureAdded', response => {
        $("#myToast").toast('show');
    })

    
</script>
    
@endpush