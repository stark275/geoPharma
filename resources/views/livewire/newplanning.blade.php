<div>
    <div class="row justify-content-center" >
            <div class="col-md-12">
                <br>
                    @if ($hasPlanning == false)
                        <form wire:submit.prevent="submit">
                            <div class="form-group">
                            <label for="exampleInputEmail1">Donnez un à votre planing </label>
                                <input wire:model="planningName" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                @error('planningName') <span style="color: pink">{{ $message }}</span> @enderror
                                <small id="emailHelp" class="form-text text-muted">Ce nom est arbitraire.</small>
                            </div>
                            <button class="btn btn-primary">Créer</button>
                        </form>
                    @else
                    <h4 id="planning-id" data-planning-id="{{$planningId}}">{{$planningName}}</h4>
                        <ul class="list-group">
                            
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{'Médicaments'}}
                                    <span class="badge ">{{'Quantité'}}</span> 
                                    <span class="badge badge-primary badge-pill">{{'Prix'}}</span>
                                </li>
                                <br>
                                
                            @forelse ($features as $f)
                                <a href="#" data-lat="{{$f['shop']->latitude}}" data-lng="{{$f['shop']->longitude}}" class="drug">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{$f['drug']->name}}
                                    <span class="badge badge-dark badge-pill ">{{$f['qty']}}</span> 
                                    <span class="badge badge-primary badge-pill">{{number_format($f['price']->price, 2, ',', ' ').' CDF'}}</span>
                                    </li>
                                </a>        
                            @empty
                                    
                            @endforelse

                            <br>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{' TOTAL -------------------->>>>>'}}
                                
                                <span class="badge badge-primary badge-pill">{{number_format($planningPrice, 2, ',', ' '). ' CDF'}}</span>
                            </li>
                        </ul> 
                        <a href="{{route('planning.show',$planningId)}}" class="btn btn-primary mt-3">Générer le parcour</a>
                        <button class="btn btn-warning mt-3" onclick="hideItinerary()">Instruction</button>
                    @endif    
            </div>
        </div>
</div>
