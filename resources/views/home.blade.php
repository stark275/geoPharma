@extends('layouts.app')
@section('content') 
<style>
    .mp{
        width: 100%;
        background-color: rgb(82, 83, 83);
        height: 87vh;
      
    }
</style>

<div class="row">
    <div class="col-md-9" style="background-color:  rgb(82, 83, 83);height: 85vh;">
        <div id="map" class="map">
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
                <!-- Single Recent Post -->
                <div class="single-recent-post d-flex align-items-center">
                    <!-- Thumb -->
                    <div class="post-thumb">
                        <a href="single-blog.html"><img src="img/bg-img/41.jpg" alt=""></a>
                    </div>
                    <!-- Content -->
                    <div class="post-content">
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <a href="#" class="post-author">Dec 19, 2019</a>
                        </div>
                        <a href="single-blog.html" class="post-title">Pos Hardware More Options In</a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
    
@endsection

@push('scripts')

<script>
     axios.get('{{ route('api.shops.index') }}')
    .then(function (response) {
        console.log(response.data);

    })
    .catch(function (error) {
        console.log(error);
    });
</script>
    
@endpush