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
            <p class="title">
                Ciao <span class="text-brand title">{{Auth::user()->name}}</span>, 
                @if (count($apartments)>0)
                <span>ecco i tuoi appartamenti</span>
                @else
                <span>aggiungi il tuo primo appartamento!</span>
                @endif
            </p>
            <a href="{{ route('user.apartments.create') }}" class="bnbButton my-3">Aggiungi un appartamento</a>
        </div>
        
        <div class="col-12 mt-4">
            <div class="row g-0">
                @foreach ($apartments as $apartment)
                <div class="apartment-container row col-12 g-0">
                    @if ($apartment->sponsored_until > date('Y-m-d H:i:s'))
                        <p class="sponsor-alert">sponsor scade tra: 
                                @php
                                    $diff = abs(strtotime($apartment->sponsored_until) - strtotime(date('Y-m-d H:i:s')));
                                    $remainingDays = (int)($diff / 60 / 60 / 24);
                                    $remainingHours = (int)((int)($diff - ($remainingDays * 24*60*60)) / 60 / 60)
                                @endphp

                                @if ($remainingDays >= 1)
                                        {{
                                            $remainingDays
                                        }}
                                    @if ($remainingDays > 1)
                                        giorni,
                                    @else
                                        giorno,
                                    @endif
                                @endif

                                @if ($remainingHours >= 1)
                                        {{
                                            $remainingHours
                                        }}
                                    @if ($remainingHours > 1)
                                    ore,
                                    @else
                                        ora,
                                    @endif
                                @endif
                        </p>
                    @endif
                    <div class="row col-12 col-md-8 col-lg-9 align-items-center content">
                        <div class="col-1 d-none d-md-flex sponsor-wrapper">
                            <a href="{{ route('user.sponsorshipIndex', $apartment->slug) }}">
                                @if ($apartment->sponsored_until > date('Y-m-d H:i:s'))
                                    <i class="fa-solid fa-star"></i>
                                @else
                                    <i class="fa-regular fa-star" class="d-block"></i>
                                @endif
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

@section('footer_content')
@include('./layouts/footer')
@endsection