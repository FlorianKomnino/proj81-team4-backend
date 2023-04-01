@extends('layouts.app')
@section('content')
<div id="user-news" class="container">
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
                ecco <span class="text-brand">tutti</span> i tuoi messagi
            </p>
        </div>
        
        <div class="col-12 mt-4">
            <div class="row g-0">
                @foreach ($apartments as $apartment)
                <div class="apartment-container row col-12 g-0 justify-content-between">
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
                    <div class="col-3 d-none d-sm-block img-wrapper p-0">
                        <img src="{{$apartment->image}}" alt="">
                    </div>
                    <div class="row p-0 col-8">
                        <div class="col-12 p-3 fw-bold fs-5 pe-0 pe-xl-5 align-self-center">{{ $apartment->title }}</div>
                        <div class="col-12 p-3 align-self-center">
                            <p>ci sono <span class="text-brand"> {{count($apartment->messages->where('status',0))}}</span> messaggi non letti</p>
                        </div>
                    </div>
                    <div class="col-2 col-sm-1 d-flex justify-content-evenly apartment-buttons">
                        <a href="{{ route('user.messages.index', $apartment ) }}" class="d-flex visualize-button align-items-center justify-content-center"><i class="fa-solid fa-eye"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection