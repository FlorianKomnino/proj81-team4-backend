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

        <div class="col-12">
            <table class="table table-hover text-center">
                <thead class="align-middle">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">title</th>
                        <th scope="col">address</th>
                        <th scope="col">services</th>
                        <th scope="col">
                            <a href="{{ route('user.apartments.create') }}" class="btn btn-lg btn-primary my-3 w-100">Add a new apartment</a>
                        </th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($apartments as $apartment)
                    <tr>
                        <th scope="row">{{ $apartment->id }}</th>
                        <td>{{ $apartment->title }}</td>
                        <td>{{ $apartment->address }}</td>
                        <td>
                                @forelse ($apartment->services as $service )
                                    #{{ $service->name }}
                                @empty
                                    No services included
                                @endforelse
                            </td>
                        <td>
                            <a href="{{ route('user.apartments.show', $apartment->id ) }}" class="btn btn-primary btn-sm w-25">Vai all'appartamento</a>
                            <a href="{{ route('user.apartments.edit', $apartment->id) }}" class="btn btn-warning btn-sm w-25 m-0">Modifica l'appartamento</a>
                            <form class="form-deleter d-inline w-25 m-0" action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST" data-element-name="{{ $apartment->title }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm w-100">Elimina l'appartamento</button>
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