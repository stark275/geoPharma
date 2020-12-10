@extends('layouts.geopharma')

@section('content')
  <div class="row">
        <div class="col cover">

        </div>

  </div>

  <div class="row">
      @forelse ($drugs as $drug)
           <div class="col-md-3 col-xl-3">
				<div class="card mb-3">
                        <img class="img-fluid card-img-top" src="{{asset('assets/images/slider/img-slide-3.jpg')}}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <a href="#!" class="btn  btn-primary">Ajouter</a>
                                <strong class="card-text">22.0000 CDF</strong>
                                
                            </div>
                        </div>
                    </div>
      @empty
          <div class="col-lg-12">
              <h3>Aucun médicament pour le moment</h3>
          </div>
      @endforelse

      {{$drugs->links()}}
      
    </div>
    
    
@endsection

@push('scripts')


   
@endpush