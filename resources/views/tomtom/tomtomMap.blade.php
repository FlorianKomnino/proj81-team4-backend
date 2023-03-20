@extends('layouts.app')

@section('head')
    @vite(['resources/js/tomtom.js'])
@endsection

@section('content')
    <div class="container tomtom-container my-5">
        <div class="row w-50">
            <div class="input-group mb-3 col-3 p-0">
                <input type="text" class="form-control shadow-none" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                placeholder="Search" id="locationQuery">
                <button id="searchLocation" href="#">Submit</button>
            </div>
        </div>
        <div id="map" class="map">
            <div id="marker" class="d-flex justify-content-center align-items-center"><font-awesome-icon icon="fa-solid fa-house" class="icon"/></div>
        </div>
    </div>
@endsection