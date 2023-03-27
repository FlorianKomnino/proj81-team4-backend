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
                <div class="card">
                    <div class="card-title">
                        Livello junior
                    </div>
                    <div class="card-body">
                        <p>
                            Sponsorizzazione livello base della durata di 24 ore.
                        </p>
                        <p>
                            Costo 2,99&euro;
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('user.paymentForm')}}" class="btn btn-success">
                            Vai al pagamento
                        </a>
                    </div>
                </div> 
                <div class="card">
                    <div class="card-title">
                        Livello senior
                    </div>
                    <div class="card-body">
                        <p>
                            Sponsorizzazione livello base della durata di 72 ore.
                        </p>
                        <p>
                            Costo 5.99&euro;
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('user.paymentForm')}}" class="btn btn-success">
                            Vai al pagamento
                        </a>
                    </div>
                </div>                 <div class="card">
                    <div class="card-title">
                        Livello professional
                    </div>
                    <div class="card-body">
                        <p>
                            Sponsorizzazione livello base della durata di 144 ore.
                        </p>
                        <p>
                            Costo 9.99&euro;
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('user.paymentForm')}}" class="btn btn-success">
                            Vai al pagamento
                        </a>
                    </div>
                </div> 
            </div>

        </div>
    </div>
</div>


@endsection

