@extends('layouts.app')

@section('head')
    @vite(['resources/js/deleteForm.js'])
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
                        <th scope="col">Titolo</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Disponibilità</th>
                        <th scope="col">Servizi</th>
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