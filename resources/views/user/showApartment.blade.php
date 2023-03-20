@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <h3 class="my-3">{{$apartment->title}}</h3>
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
                                <h3 class="text-danger">tipologia della casa</h3>
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

                    <div class="col-12 border-top border-secondary"></div>

                    <div class="col-12">
                        <h5 class="mt-4">Dove ti troverai</h5>
                        <p>{{$apartment->address}}</p>
                        <div class="col-12 bg-secondary" style="height: 280px;">
                            <p class="text-light ms-2">tomtom map</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection