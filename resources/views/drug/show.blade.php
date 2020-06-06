@extends('layouts.app')
@section('content') 
<style>
    .mp{
        width: 100%;
        background-color: rgb(82, 83, 83);
        height: 87vh;
      
    }

    #map{
        height: 85vh;
        width: 100%;
    }
</style>

<div class="row">
    <div class="col-md-9" style="background-color:  rgb(82, 83, 83);height: 85vh; padding:0;">
        <div id="map" class="">
            home
        </div>
    </div>
    <div class="col-md-3" style="overflow-y: scroll">
        <div class="rehomes-sidebar-area" style="max-height: 80vh">
            <!-- Single Widget Area -->
            <div class="single-widget-area wow fadeInUp" data-wow-delay="200ms">
                <div class="newsletter-form">
                    <form action="#" method="post">
                        <input type="email" name="nl-email" id="nlEmail" class="form-control" placeholder="Search...">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
         <!-- Single Widget Area -->
            <div class="single-widget-area wow fadeInUp" data-wow-delay="200ms">
                @forelse ($shops as $shop)
                    <!-- Single Recent Post -->
                <div class="single-recent-post d-flex align-items-center" style="border-bottom: solid 1px grey ">
                    <!-- Content -->
                    <div class="post-content">  
                    <a href="single-blog.html" class="post-title">{{$shop->name}}</a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                        <a href="#" class="post-author">{{$shop->pivot->price.' CDF'}}</a>
                        </div>
                    </div>
                    <hr>
                </div>
                @empty
                    
                @endforelse

            </div>
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

   

    axios.get('{{ route('api.shops.specificaldrug',['id' => $shop->id]) }}')
    .then(function (response) {
        console.log(response.data);

        L.geoJSON(response.data, {
            pointToLayer: function(geoJsonPoint, latlng) {

                return L.marker(latlng);
            }
        })
        .bindPopup(function (layer) {
            
            return layer.feature.properties.drug_info;
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

    
</script>
    
@endpush