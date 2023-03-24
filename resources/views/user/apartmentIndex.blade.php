@extends('layouts.app')

@section('head')
    @vite(['resources/js/confirmDeletation.js'])
@endsection
    
@section('content')
        @include('user.partials.popUp')
        
<div class="container">
    <div class="row">
        @if (session('message'))
        <div class="col-12">
            <div class="alert alert-{{ session('alert-type') }} mb-3">
                    {{ session('message') }}
            </div>
        </div>
        @endif


        <h1 class="text-center">
            I tuoi appartamenti
        </h1>
        <div class="col-12">
            <table class="table table-hover text-center">
                <thead class="align-middle">
                    <tr>
                        <th scope="col">Titolo</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Disponibilità</th>
                        <th scope="col">Servizi</th>
                        <th scope="col">
                            <a href="{{ route('user.apartments.create') }}" class="btn btn-lg btn-primary my-3 w-100">Aggiungi un appartamento</a>
                        </th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($apartments as $apartment)
                    <tr>
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
                                <button class="btn btn-danger btn">Elimina</button>
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