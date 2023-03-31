@extends('layouts.app')

@section('head')
    @vite(['resources/js/tomtom.js'])
@endsection

@section('content')
    <div class="container-fluid container-md mb-5">
        <div class="row wrapper g-0">
            @if (session('message'))
            <div class="alert alert-{{ session('alert-type') }}">
                {{ session('message') }}
            </div>
            @endif
            <div class="col-12">
                <div class="col-12 d-flex justify-content-between align-items-center mb-1">
                    <p class="title m-0">{{ucfirst($apartment->title)}}</p>
                    <div>
                        <a href="{{ route('user.messages.index', $apartment) }}" class="bnbButton">Statistiche e messaggi</a>
                    </div>
                </div>
                <p class="smTextSize text-decoration-underline ">
                    {{$apartment->address}}
                </p>
                <div class="row justify-content-center g-0">
                    <div class="col-12 col-md-6 pb-1 pb-md-0 pe-md-1">
                        @if (str_starts_with($apartment->image, 'http'))
                            <img src="{{$apartment->image}}"
                        @else
                            <img src="{{asset('storage/' . $apartment->image)}}"
                        @endif
                        alt="apartment cover" class="img-fluid h-100 rounded-2">
                    </div>
                    <div class="col-12 col-md-6 p-0 ps-md-1">
                        <div id="map" class="map rounded-2">
                            <div id="marker">
                                <svg class="marker-container" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 g-0">
                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between description">
                                <div class="description">
                                    <p class="subTitleSize mb-1">Caratteristiche dell'alloggio</p>
                                    <p class="textSize m-0">
                                        {{($apartment->rooms == 1) ? $apartment->rooms.' stanza' : $apartment->rooms.' stanze'}} &#8226; 
                                        {{($apartment->beds == 1) ? $apartment->beds.' letto' : $apartment->beds.' letti'}} &#8226;
                                        {{($apartment->bathrooms == 1) ? $apartment->bathrooms.' bagno' : $apartment->bathrooms.' bagni'}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-10 border-top border-secondary my-3"></div>
                        <div class="row service-box g-0">
                            <div class="col-12">
                                <p class="subTitleSize mb-1">Servizi che hai aggiunto</p>
                                @foreach ($apartment->services as $service)
                                    <div class="textSize mb-1">
                                        <i class="{{$service->icon}} me-1"></i>
                                        <span>{{$service->name}}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex d-lg-none border-top border-secondary my-3"></div>
                
                {{-- these rows (56-63) is used to send coordinates to tomtom.js and visualize the map --}}
                <div class="row w-50 d-none">
                    <div class="input-group mb-3 col-3 p-0">
                        <input name="coordinate[]" type="text" class="form-control shadow-none" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                        placeholder="Search" id="locationQuery" value="{{$apartment->longitude}}">
                        <input name="coordinate[]" type="text" class="form-control shadow-none" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                        placeholder="Search" id="locationQuery" value="{{$apartment->latitude}}">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection