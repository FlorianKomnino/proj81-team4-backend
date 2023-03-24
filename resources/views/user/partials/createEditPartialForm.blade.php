@section('head')
    @vite(['resources/js/tomtom.js'])
@endsection

<div id="container-form" class="container my-5">
    <form action="{{ route($route, $apartment->slug) }}" id="form" class="m-auto" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method($formMethod)

        <h2 class="text-center m-0 p-3 fw-bold">
            {{ $formMethod === 'POST' ? 'Crea un nuovo appartamento' : "Modifica l'appartamento '$apartment->title'" }}
        </h2>
        <div class="d-flex flex-column p-2 pb-4">
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <span class="lightGreyText">Titolo descrittivo per l'appartamento:</span>
            <textarea class="p-0 border-0" name="title">{{ old('title', $apartment->title) }}</textarea>
        </div>
        <hr>
        <div class="d-flex flex-column p-2 pb-4">
            @error('rooms')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <span class="lightGreyText">Numero di stanze:</span>
            <input type="number" value="{{ old('rooms', $apartment->rooms) }}" class="p-0 border-0" name="rooms">
        </div>
        <hr>
        <div class="d-flex flex-column p-2 pb-4">
            @error('beds')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <span class="lightGreyText">Numero di letti:</span>
            <input type="number" value="{{ old('beds', $apartment->beds) }}" class="p-0 border-0" name="beds">
        </div>
        <hr>
        <div class="d-flex flex-column p-2 pb-4">
            @error('bathrooms')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <span class="lightGreyText">Numero di bagni:</span>
            <input type="number" value="{{ old('bathrooms', $apartment->bathrooms) }}" class="p-0 border-0" name="bathrooms">
        </div>
        <hr>
        <div class="d-flex flex-column p-2 pb-4">
            @error('square_meters')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <span class="lightGreyText">Metri quadri:</span>
            <input type="number" value="{{ old('square_meters', $apartment->square_meters) }}" class="p-0 border-0" name="square_meters">
        </div>
        <hr>
        <div class="p-2 pb-4">
            @if ($route == 'user.apartments.update')
                <span class="lightGreyText">Indirizzo attuale dell'appartamento:</span>
                <span class="fw-bold">{{ old('address', $apartment->address) }}</span>
                <input type="text" value="{{ old('address', $apartment->address) }}" class="d-none inputAddress" name="address">
                <p class="m-0 lightGreyText">Se vuoi cambiarlo, cerca il nuovo qui sotto!</p>
            @else
                <span class="lightGreyText">Indirizzo dell'appartamento:</span>
                <input type="text" value="{{ old('address', $apartment->address) }}" class="d-none inputAddress" name="address">
            @endif
            @error('address')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            @if (session('message'))
                <p class="text-danger">{{session('message')}}</p>
            @endif
            {{-- Old input, verify if the new implementation is okay --}}
            {{-- <input type="text" value="{{ old('address', $apartment->address) }}" class="p-0 border-0" placeholder="Indirizzo dell'appartamento" name="address"> --}}

            {{-- This is the div in which there il will be the search bar by Tomtom, it is added by "tomtom.js" --}}
            <div class="searchBar"></div>
        </div>
        <hr>
        <div class="d-flex mt-1 p-2 py-3">
            <input class="form-check-input me-2" type="checkbox" value="1" {{ old('visible', $apartment->visible) ? 'checked' : '' }} name="visible" id="visible">
            <label class="form-check-label" for="visible">Visibile al pubblico <em>(Spunta questa casella per rendere subito visibile il tuo appartamento)</em></label>
        </div>
        <hr class="mb-0">

        <label for="form-file" class="lightGreyText p-2 py-3">Carica una foto per rendere il tuo appartamento ancora più visibile!</label>
        <div class="p-0 d-flex">
            @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <input class="form-control rounded-0" type="file" placeholder="no file selected" name="image" id="form-file">
        </div>

        <div class="p-2 mt-2">
            <span class="lightGreyText">Che servizi offre la casa?</span>
            <div class="d-flex justify-content-between">
                @foreach ($services as $service)
                    <div class="single-tag d-flex align-items-center my-2">
                        <input type="checkbox" class="form-check-input" name="services[]" value="{{ $service->id }}"
                            @if ($errors->any()) @checked(in_array($service->id, old('services',[])))
                            @else
                                @checked($apartment->services->contains($service->id)) @endif>
                        <label class="form-check-label ms-2">{{ $service->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <hr>

        <div class="d-flex justify-content-center">
            <button type="submit" class="m-2 bnbButton">{{ $formMethod === 'POST' ? 'Carica l\'appartamento a sistema' : "Modifica l'appartamento" }}</button>
        </div>
    </form>
</div>
