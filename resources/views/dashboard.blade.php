@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="row">
                <div class="col-4 card">
                    {{-- <div class="card-header">{{ __('User Dashboard') }}</div> --}}
    
                    <div class="card-body">
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
                    <h2>Ciao {{Auth::user()->name}}!</h2>
                    <p class="text-secondary">Su Bool BnB dal {{substr(Auth::user()->created_at,0,4)}}</p>
                    <p class="text-decoration-underline my-3">modifica il profilo</p>
                    <a href="" class="btn btn-secondary">+ aggiungi appartamento</a><br>
                    <a href="" class="btn btn-secondary my-3">Messaggi</a><br>
                    <a href="" class="btn btn-secondary">&star; Visualizzazioni</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
