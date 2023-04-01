@extends('layouts.app')
@section('head')
    <script>    
        var apartments = {!! json_encode($apartments->toArray()) !!};
    </script>
    @vite(['resources/js/confirmDeletation.js', 'resources/js/chartsTotalStats.js'])
@endsection

@section('content')
<div id="visualizations-index" class="container">
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
            <p class="title mb-5">
                Statistiche visualizzazioni singoli appartamenti
            </p>
            <div class="row g-0">
                @foreach ($apartments as $apartment)
                <div id="container{{ $loop->index }}" class="apartment-container row col-6 g-0">
                    <div class="col-3 d-none d-sm-block img-wrapper p-0">
                        <img src="{{$apartment->image}}" alt="">
                    </div>
                    <div class="row p-0 col-8">
                        <p>{{$apartment->title}}</p>
                        <canvas id="{{ $loop->index }}"></canvas>
                    </div>
                    <div class="col-2 col-sm-1 d-flex justify-content-evenly apartment-buttons">
                        <a href="{{ route('user.messages.index', $apartment->slug ) }}" class="d-flex visualize-button align-items-center justify-content-center"><i class="fa-solid fa-eye"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection