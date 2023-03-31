@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>
                Seleziona la tua sponsorizzazione per:
            </h1>
            <h1>
                {{$apartment->title}}
            </h1>
            <div class="cards-container">
                @foreach ($sponsorships as $sponsorship)
                <div class="card">
                    <div class="card-title">
                        Livello {{$sponsorship->type}}
                    </div>
                    <div class="card-body">
                        <p>
                            Sponsorizzazione livello base della durata di {{$sponsorship->duration_hours}} ore.
                        </p>
                        <p>
                            Costo {{$sponsorship->price}}&euro;
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('user.paymentForm', [$apartment->slug, $sponsorship])}}" class="btn btn-success">
                            Vai al pagamento
                        </a>
                    </div>
                </div> 
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection

