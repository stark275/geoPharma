<div>
    <div class="form-group mt-10">
        <label for="exampleInputEmail1">Nom du médicament</label>
        <input type="text" 
            class="form-control"
            wire:model.debounce.450ms="search"
            placeholder="Ex: Amoxy" 
            id="exampleInputEmail1" 
            autocomplete="off" 
            aria-describedby="emailHelp"
        >
    </div>

    <div class="list-group">
        @foreach ($drugs as $drug)
            <a href="{{route('drug.show',$drug->id)}}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                <h4 class="mb-1"><strong>{{$drug->name}}</strong></h4>
                <small>10 pharmacies </small>
                </div>
                <p class="mb-1">
                  <em>{{strtoupper($drug->labo)}}</em> <br><br>
                    {{ucfirst($drug->description)}}
                </p>
                <small> ______</small>
            </a>
        @endforeach

        @if (count($drugs) === 0)
            <div class="alert alert-info"> Aucun resultat pour <strong>{{$search}}</strong></div>
        @endif
        
    </div>
</div>
