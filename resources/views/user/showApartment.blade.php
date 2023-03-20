@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <h2 class="text-danger">nome appartamento</h2>
            <p><span class="text-danger">13 recensioni</span> &dot; <span class="text-danger">Nome Utente</span></p>
            <div class="row">
                <div class="col-6">
                    <pre>main image</pre>
                    @if (str_starts_with($apartment->image, 'http'))
                        <img src="{{$apartment->image}}"
                    @else
                        <img src="{{asset('storage/' . $apartment->image)}}"
                    @endif
                    alt="apartment cover" class="img-fluid">
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6"><pre>image 2</pre></div>
                        <div class="col-6"><pre>image 3</pre></div>
                        <div class="col-6"><pre>image 4</pre></div>
                        <div class="col-6"><pre>image 5</pre></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="d-flex justify-content-between">
                            <div class="description">
                                <h3 class="text-danger">tipologia della casa</h3>
                                <p>{{$apartment->beds}} letto &dot; {{$apartment->bathrooms}} bagno</p>
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
                        <h3>Dove ti troverai</h3>
                        <p>{{$apartment->address}}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection