@extends('layouts.app')

@section('head')
    @vite(['resources/js/confirmDeletation.js'])
@endsection

@section('content')
<div class="container">
    <div class="row">
        @if (session('message'))
        <div class="col-12">
            <div class="alert alert-{{ session('alert-type') }} mb-3">
                    {{ session('message') }}
            </div>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-center">
                Ciao {{Auth::user()->name}}, ecco i tuoi appartamenti
            </h2>
            <a href="{{ route('user.apartments.create') }}" class="bnbButton my-3">Aggiungi un appartamento</a>
        </div>
        
        <div class="col-12">
            <table class="table table-hover text-center">
                <thead class="align-middle">
                    <tr>
                        <th scope="col">Sponsor</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Disponibilità</th>
                        <th scope="col">Servizi</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($apartments as $apartment)
                    <tr>
                        <td>
                            <a href="{{ route('user.sponsorshipIndex', $apartment->slug) }}">
                                @if ($apartment->sponsored_until > date('Y-m-d H:i:s'))
                                    <i class="fa-solid fa-star"></i>

                                    <p>sponsor scade tra: 
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
                                @else
                                    <i class="fa-regular fa-star" class="d-block"></i>
                                @endif
                            </a>
                        </td>
                        <td>{{ $apartment->title }}</td>
                        <td>{{ $apartment->address }}</td>
                        <td>
                            <form action="{{ route('user.apartments.toggle', $apartment->slug) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <button type="submit" title="{{$apartment->visible ? 'disponibile' : 'non disponibile' }}" class="btn btn-outline" ><i class="fa-2x fa-solid fas fa-fw {{$apartment->visible ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i></button>
                            </form>
                        </td>
                        <td>
                            @forelse ($apartment->services as $service )
                                #{{ $service->name }}
                            @empty
                                Nessun servizio incluso
                            @endforelse
                        </td>
                        <td>
                            <a href="{{ route('user.apartments.show', $apartment->slug ) }}" class="btn btn-primary btn">Visualizza</a>
                            <a href="{{ route('user.apartments.edit', $apartment->slug) }}" class="btn btn-warning btn m-0">Modifica</a>
                            <form class="form-deleter d-inline" action="{{ route('user.apartments.destroy', $apartment->slug) }}" method="POST" data-element-name="{{ $apartment->title }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Elimina</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection