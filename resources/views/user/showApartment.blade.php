@extends('layouts.app')

@section('head')
    @vite(['resources/js/tomtom.js'])
@endsection

@section('content')
    <div class="container">
        <div class="row wrapper">
            @if (session('message'))
            <div class="alert alert-{{ session('alert-type') }}">
                {{ session('message') }}
            </div>
            @endif
            <div class="col-12">
                <div class="col-12 d-flex justify-content-between">
                    <h3>{{$apartment->title}}</h3>
                    <a href="{{ route('user.messages', $apartment) }}" class="btn btn-primary">Statistiche e messaggi</a>
                </div>
                
                <p><span class="text-danger">13 recensioni</span> - <span>{{$user->name}}</span></span></p>
                <div class="row justify-content-center">
                    <div class="col-4">
                        @if (str_starts_with($apartment->image, 'http'))
                            <img src="{{$apartment->image}}"
                        @else
                            <img src="{{asset('storage/' . $apartment->image)}}"
                        @endif
                        alt="apartment cover" class="img-fluid h-100">
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-5 bg-dark m-2" style="height: 120px"></div>
                            <div class="col-5 bg-dark m-2" style="height: 120px"></div>
                            <div class="col-5 bg-dark m-2" style="height: 120px"></div>
                            <div class="col-5 bg-dark m-2" style="height: 120px"></div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-8">
                            <div class="d-flex justify-content-between">
                                <div class="description">
                                    <h3 class="text-danger">Tipologia della casa</h3>
                                    <p>
                                        {{($apartment->rooms == 1) ? $apartment->rooms.' stanza' : $apartment->rooms.' stanze'}} - 
                                        {{($apartment->beds == 1) ? $apartment->beds.' letto' : $apartment->beds.' letti'}} -
                                        {{($apartment->bathrooms == 1) ? $apartment->bathrooms.' bagno' : $apartment->bathrooms.' bagni'}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <p>prezzo per notte</p>
                            </div>
                        </div>
                    </div>
                    <div class="row service-box m-0">
                        <h3 class="text-danger">Cosa troverai</h3>
                        @foreach ($apartment->services as $service)
                        <div class="col-2  services">
                            <p>
                                <span><i class="{{$service->icon}}"></i></span>
                                <span></span>{{$service->name}}
                            </p>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-12 border-top border-secondary"></div>

                    <div class="col-12">
                        <h5 class="mt-4">Indirizzo dell'appartamento</h5>
                        <div class="icon"></div>
                        <p>{{$apartment->address}}</p>
                        <div class="tomtom-container mb-5">
                            {{-- these rows (56-63) is used to send coordinates to tomtom.js and visualize the map --}}
                            <div class="row w-50 d-none"> 
                                <div class="input-group mb-3 col-3 p-0">
                                    <input name="coordinate[]" type="text" class="form-control shadow-none" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                    placeholder="Search" id="locationQuery" value="{{$apartment->longitude}}">
                                    <input name="coordinate[]" type="text" class="form-control shadow-none" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                    placeholder="Search" id="locationQuery" value="{{$apartment->latitude}}">
                                </div>
                            </div>
                            <div id="map" class="map">
                                <div id="marker">
                                    <svg class="marker-container" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection