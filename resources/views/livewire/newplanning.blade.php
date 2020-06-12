<div>
    <div class="row justify-content-center" >
            <div class="col-md-12">
                <br>
                @if ($hasPlanning == false)
                     <form wire:submit.prevent="submit">
                        <div class="form-group">
                        <label for="exampleInputEmail1">Donnez un à votre planing </label>
                            <input wire:model="planning" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                            @error('planning') <span style="color: pink">{{ $message }}</span> @enderror
                            <small id="emailHelp" class="form-text text-muted">Ce nom est arbitraire.</small>
                        </div>
                        <button class="btn btn-primary">Créer</button>
                    </form>
                @else
                   <h4 id="planning-id" data-planning-id="{{$planningId}}">{{$planningName}}</h4>
                    <ul class="list-group">
                        @forelse ($features as $f)
                            <a href="#" data-lat="{{$f['shop']->latitude}}" data-lng="{{$f['shop']->longitude}}" class="drug">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{$f['drug']->name}}
                                <span class="badge badge-primary badge-pill">{{$f['price']->price.' CDF'}}</span>
                                </li>
                            </a>        
                        @empty
                    </ul>       
                   @endforelse
                @endif

                  

            </div>
        </div>
</div>
