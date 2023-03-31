@extends('layouts.app')

@section('content')

<div id="sponsorship-index" class="container">
    <div class="row">
        <div class="col-12">
            <h1>
                Seleziona la tua <span class="brand-color">sponsorizzazione</span> per:
            </h1>
            <h1>
                {{$apartment->title}}
            </h1>
            <div class="row cards-container">
                @foreach ($sponsorships as $sponsorship)
                <div class="card-wrapper col-12 col-md-4 my-3 p-2">
                    <div class="card">
                        <div class="card-title">
                            <h4 class="m-3"> 
                                Livello <span class="brand-color">{{$sponsorship->type}}</span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <p class="py-4">
                                Sponsorizzazione livello base della durata di <span class="brand-color">{{$sponsorship->duration_hours}}</span> ore.
                            </p>
                            <p class="py-4">
                                Costo <span class="brand-color">{{$sponsorship->price}}&euro;</span>
                            </p>
                            <a href="{{route('user.paymentForm', [$apartment->slug, $sponsorship])}}" class="my-4">
                                Vai al pagamento
                            </a>
                        </div>
                    </div> 
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection

