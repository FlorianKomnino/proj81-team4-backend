@extends('layouts.app')

@section('content')
    <div id="container-form" class="container my-4">
        <form action="{{ route('user.apartments.store') }}" id="form" class="m-auto" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex flex-column p-2">
                <textarea class="p-0 border-0" placeholder="Breve descrizione dell'appartamento" name="description"></textarea>
            </div>
            <hr>
            <div class="d-flex flex-column p-2">
                <input type="number" class="p-0 border-0" placeholder="Numero di stanze" name="rooms">
            </div>
            <hr>
            <div class="d-flex flex-column p-2">
                <input type="number" class="p-0 border-0" placeholder="Numero di letti" name="beds">
            </div>
            <hr>
            <div class="d-flex flex-column p-2">
                <input type="number" class="p-0 border-0" placeholder="Numero di Bagni" name="bathrooms">
            </div>
            <hr>
            <div class="d-flex flex-column p-2">
                <input type="number" class="p-0 border-0" placeholder="Metri quadrati" name="square_meters">
            </div>
            <hr>
            <div class="d-flex flex-column p-2">
                <input type="text" class="p-0 border-0" placeholder="Indirizzo dell'appartamento" name="address">
            </div>
            <hr class="mb-0">
            <div class="p-0 d-flex">
                <label for="file-upload" class="custom-file-upload d-flex align-content-center p-1">
                    <span class="d-flex justify-content-center align-items-center">Inserisci un'immagine</span>
                    <input id="file-upload" type="file" class="p-0 border-0" placeholder="Immagine" name="image">
                </label>
            </div>
            <hr class="mt-0">
            <div class="p-0 d-flex">
                {{-- @foreach ($services as $service)
                    <div class="single-tag d-flex align-items-center">
                        <input type="checkbox" class="form-check-input" name="technologies[]" value="{{ $service->id }}"
                        @if ($errors->any())
                            @checked(in_array($service->id, old('services',[])))
                        @else
                            @checked($apartment->services->contains($service->id))
                        @endif>
                        <label class="form-check-label ms-2">{{ $service->name }}</label>
                    </div>
                @endforeach --}}
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection