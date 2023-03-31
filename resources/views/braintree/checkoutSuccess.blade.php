@extends('layouts.app')

@section('content')
<div id="payment-checkout-success" class="container">
    <div class="row">
        <h2 class="col-12 my-3">
            La <span class="brand-color">Transazione</span> è avvenuta con successo
        </h2>
        <p class="my-5 col-12 col-lg-10 offset-lg-1">Grazie per averci <span class="brand-color"></span> scelto! Ora il <span class="brand-color">tuo </span>appartamento ora risulterà <span class="brand-color">in evidenza</span> e potrà godere di <span class="brand-color">grande visibilità</span>! Non ti dimenticare di rendere <span class="brand-color">visibile</span> il tuo appartamento e ricorda di tenere d'occhio il tempo di sponsorizzazione restante per ogni tuo appartamento così da restare <span class="brand-color">primo</span> in classifica!</p>
        <div class="col-12 col-md-6">
            <a href="{{ route('user.apartments.index' ) }}">Torna agli appartamenti</a>
        </div>
    </div>
</div>
@endsection