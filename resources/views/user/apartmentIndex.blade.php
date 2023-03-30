@extends('layouts.app')

@section('head')
    @vite(['resources/js/confirmDeletation.js'])
@endsection

@section('content')
<div id="apartment-index" class="container">
    <div class="row">
        @if (session('message'))
        <div class="col-12">
            <div class="alert alert-{{ session('alert-type') }} mb-3">
                    {{ session('message') }}
            </div>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center">
            <h2>
                Ciao <span class="text-brand">{{Auth::user()->name}}</span>, ecco i tuoi appartamenti
            </h2>
            <a href="{{ route('user.apartments.create') }}" class="bnbButton my-3">Aggiungi un appartamento</a>
        </div>
        
        <div class="col-12 mt-4">
            <div class="row">
                {{-- <div class="row col-12 text-center">
                    <div class="col-1">
                        <h4>
                            Sponsor
                        </h4> 
                    </div>
                    <div class="col-5">
                        <h4>
                            Titolo
                        </h4> 
                    </div>
                    <div class="col-3">
                        <h4>
                            Indirizzo
                        </h4> 
                    </div>
                    <div class="col-2">
                        <h4>
                            Servizi
                        </h4> 
                    </div>
                    <div class="col-1">
                        <h4>
                            Disponibilità
                        </h4> 
                    </div>
                </div> --}}
                @foreach ($apartments as $apartment)
                <div class="apartment-container row col-12">
                    <div class="row col-12 col-md-9 align-items-center content">
                        <div class="col-1 d-none d-md-block sponsor-wrapper">
                            <a href="{{ route('user.sponsorshipIndex', $apartment->slug) }}">
                                <i class="fa-regular fa-star" class="d-block"></i>
                            </a>
                        </div>
                        <div class="col-5">{{ $apartment->title }}</div>
                        <div class="col-3">{{ $apartment->address }}</div>
                        <div class="col-2">
                            @forelse ($apartment->services as $service )
                                <div class="col-12">
                                    #{{ $service->name }}
                                </div> 
                            @empty
                                Nessun servizio incluso
                            @endforelse
                        </div>
                        <div class="col-1 d-none d-md-block d-flex align-items-center justify-center">
                            <form action="{{ route('user.apartments.toggle', $apartment->slug) }}" method="POST">
                            @method('PATCH')
                            @csrf
                                <button type="submit" title="{{$apartment->visible ? 'disponibile' : 'non disponibile' }}" class="visibility-button" ><i class="fa-2x fa-solid fas fa-fw {{$apartment->visible ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 d-flex justify-content-evenly apartment-buttons">
                        <a class="col-1 d-md-none sponsor-wrapper d-flex align-items-center justify-content-center" href="{{ route('user.sponsorshipIndex', $apartment->slug) }}">
                            <i class="fa-regular fa-star"></i>
                        </a>
                        <a href="{{ route('user.apartments.show', $apartment->slug ) }}" class="d-flex visualize-button align-items-center justify-content-center"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('user.apartments.edit', $apartment->slug) }}" class="d-flex modify-button align-items-center justify-content-center"><i class="fa-solid fa-pencil"></i></a>
                        <form class="form-deleter d-inline" action="{{ route('user.apartments.destroy', $apartment->slug) }}" method="POST" data-element-name="{{ $apartment->title }}">
                            @csrf
                            @method('DELETE')
                            <button class="h-100 trash-button"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <div id="smartphone-visibility" class="col-1 d-md-none d-flex align-items-center justify-center">
                            <form action="{{ route('user.apartments.toggle', $apartment->slug) }}" method="POST">
                            @method('PATCH')
                            @csrf
                                <button type="submit" title="{{$apartment->visible ? 'disponibile' : 'non disponibile' }}" class="visibility-button" ><i class="fa-2x fa-solid fas fa-fw {{$apartment->visible ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection