@extends('layouts.app')
@section('head')
    @vite(['resources/js/confirmDeletation.js'])
@endsection

@section('content')
<div id="apartment-index" class="container">
    <div class="row">

        <div class="d-flex justify-content-between align-items-center">
            <p class="title">
                Statistiche totali delle visualizzazioni
            </p>
        </div>
        
        <div class="general-stats col-12 m-3">
                <canvas id="myChart"></canvas>
        </div>

        <div class="col-12 mt-4">
            <div class="row g-0">
                @foreach ($apartments as $apartment)
                <div class="apartment-container row col-6 g-0">
                    
                    <div class="row col-12 col-md-8 col-lg-9 align-items-center content">
                        <div class="col-1 d-none d-md-flex sponsor-wrapper">
                            <a href="{{ route('user.sponsorshipIndex', $apartment->slug) }}">

                            </a>
                        </div>
                        <div class="col-4 fw-bold fs-5 pe-0 pe-xl-5">{{ $apartment->title }}</div>
                        <div class="col-3">{{ $apartment->address }}</div>
                        <div class="row col-5 col-md-3 justify-content-evenly">
                            @forelse ($apartment->services as $service )
                                <div class="col-4 col-md-12 service-element d-flex align-items-center">
                                    <i class="{{ $service->icon }} py-2"></i>
                                    <span class="d-none d-lg-inline ms-2">{{$service->name}}</span>
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
                    <div class="col-12 col-md-4 col-lg-3 d-flex justify-content-evenly apartment-buttons">
                        <a class="col-1 d-md-none sponsor-wrapper d-flex align-items-center justify-content-center" href="{{ route('user.sponsorshipIndex', $apartment->slug) }}">
                            @if ($apartment->sponsored_until > date('Y-m-d H:i:s'))
                                <i class="fa-solid fa-star"></i>
                            @else
                                <i class="fa-regular fa-star" class="d-block"></i>
                            @endif
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