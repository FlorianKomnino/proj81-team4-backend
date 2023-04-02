@extends('layouts.app')

@section('content')
<div id="user-dashboard" class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-4 card">
                    {{-- <div class="card-header">{{ __('User Dashboard') }}</div> --}}
    
                    <div class="card-body d-flex flex-column text-center justify-content-evenly">
                        <h2>Ciao <span class="text-brand">{{Auth::user()->name}}</span>!</h2>
                        <p>Benvenuta/o nella dashboard del tuo profilo</p>
                        <p class="text-secondary">{{Auth::user()->email}}</p>
                        <h4 class="text-brand">Utente registrato</h4>
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="row col-12 col-lg-8 px-5 py-4">
                    <p class="text-secondary">Su Bool BnB dal {{substr(Auth::user()->created_at,0,4)}}</p>
                    <a class="col-12 col-lg-10 col-xl-8 my-2" href="{{route('user.apartments.create')}}"><i class="fa-solid fa-plus"></i> aggiungi appartamento</a><br>
                    <a class="col-12 col-lg-10 col-xl-8 my-2" href="{{route('user.apartments.index')}}"><i class="fa-solid fa-eye"></i> visualizza i tuoi appartamenti</a><br>
                    <a class="col-12 col-lg-10 col-xl-8 my-2" href="{{route('user.apartments.news')}}" ><i class="fa-solid fa-envelope"></i> Messaggi</a><br>
                    <a class="col-12 col-lg-10 col-xl-8 my-2" href="{{route('user.statistics')}}"><i class="fa-solid fa-chart-column"></i> Statistiche</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_content')
@include('./layouts/footer')
@endsection
