@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">
            <div class="row">
                <div class="col-4 card">
                    {{-- <div class="card-header">{{ __('User Dashboard') }}</div> --}}
    
                    <div class="card-body d-flex flex-column text-center justify-content-end">
                        <p class="text-center text-decoration-underline my-3">aggiungi/modifica foto</p>
                        <h4 class="text-success">Utente registrato</h4>
                        <p class="text-secondary">{{Auth::user()->email}}</p>
                        <p>benvenuto nella dashboard del tuo profilo</p>
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-8 px-5 py-4">
                    <h2 class="text-success">Ciao {{Auth::user()->name}}!</h2>
                    <p class="text-secondary">Su Bool BnB dal {{substr(Auth::user()->created_at,0,4)}}</p>
                    <p class="text-decoration-underline my-3">modifica il profilo</p>
                    <a href="{{route('user.apartments.create')}}" class="btn btn-success">+ aggiungi appartamento</a><br>
                    <a href="{{route('user.apartments.index')}}" class="btn btn-primary mt-3"> visualizza i tuoi appartamenti</a><br>
                    <a href="" class="btn btn-outline-primary my-3">Messaggi</a><br>
                    <a href="" class="btn btn-outline-warning">&star; Visualizzazioni</a>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <h2>
                        I tuoi appartamenti sponsorizzati
                    </h2>
                    <p class="fst-italic">
                        Non hai ancora sponsorizzato appartamenti
                    </p>
                    <div class="btn btn-success">Sponsorizza un'appartamento</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
