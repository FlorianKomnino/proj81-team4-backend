@section('head')
    @vite(['resources/js/tomtom.js','resources/js/clientValidations.js'])
@endsection

<div id="container-form" class="apartment-create-edit container my-5">
    <form action="{{ route($route, $apartment->slug) }}" id="form" class="m-auto" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method($formMethod)

        <p class="text-center m-0 p-3 subTitleSize">
            {{ $formMethod === 'POST' ? 'Crea un nuovo appartamento' : "Modifica l'appartamento '$apartment->title'" }}
        </p>
        {{-- title --}}
        <div class="d-flex flex-column p-2 pb-4">
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="title" class="smTextSize">Titolo:</label>
            <span id="title-error" class="text-danger invalid-feedback"></span>
            <textarea id="title" class="lineOver" name="title">{{ old('title', $apartment->title) }}</textarea>
        </div>
        <hr>
        {{-- rooms --}}
        <div class="d-flex flex-column p-2 pb-4">
            @error('rooms')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="rooms" class="smTextSize">Numero di stanze:</label>
            <span id="rooms-error" class="text-danger invalid-feedback"></span>
            <input id="rooms" type="number" value="{{ old('rooms', $apartment->rooms) }}" class="p-0 lineOver" name="rooms">
        </div>
        <hr>
        {{-- beds --}}
        <div class="d-flex flex-column p-2 pb-4">
            @error('beds')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="beds" class="smTextSize">Numero di letti:</label>
            <span id="beds-error" class="text-danger invalid-feedback"></span>
            <input id="beds" type="number" value="{{ old('beds', $apartment->beds) }}" class="p-0 lineOver" name="beds">
        </div>
        <hr>
        {{-- bathrooms --}}
        <div class="d-flex flex-column p-2 pb-4">
            @error('bathrooms')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="bathrooms" class="smTextSize">Numero di bagni:</label>
            <span id="bathrooms-error" class="text-danger invalid-feedback"></span>
            <input id="bathrooms" type="number" value="{{ old('bathrooms', $apartment->bathrooms) }}" class="p-0 lineOver" name="bathrooms">
        </div>
        <hr>
        {{-- square_meters --}}
        <div class="d-flex flex-column p-2 pb-4">
            @error('square_meters')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="square_meters" class="smTextSize">Metri quadri:</label>
            <span id="square_meters-error" class="text-danger invalid-feedback"></span>
            <input id="square_meters" type="number" value="{{ old('square_meters', $apartment->square_meters) }}" class="p-0 lineOver" name="square_meters">
        </div>
        <hr>
        {{-- address --}}
        <div class="p-2 pb-4">
            @if ($route == 'user.apartments.update')
                <span class="smTextSize">Indirizzo attuale dell'appartamento:</span>
                <span class="fw-bold">{{ old('address', $apartment->address) }}</span>
                <input type="text" id="address" value="{{ old('address', $apartment->address) }}" class="d-none inputAddress" name="address">
                <p class="m-0 lightGreyText">Se vuoi cambiarlo, cerca e seleziona dal menu un indirizzo valido!</p>
            @else
                <span class="smTextSize">Indirizzo dell'appartamento:</span>
                <input type="text" id="address" value="{{ old('address', $apartment->address) }}" class="d-none inputAddress" name="address">
            @endif
            @error('address')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            @if (session('message'))
                <p class="text-danger">{{session('message')}}</p>
            @endif
            <span id="address-error" class="text-danger invalid-feedback"></span>

            <div class="searchBar"></div>
        </div>
        <hr>
        {{-- visible --}}
        <div class="d-flex mt-1 p-2 py-3">
            <input class="form-check-input me-2" type="checkbox" value="1" {{ old('visible', $apartment->visible) ? 'checked' : '' }} name="visible" id="visible">
            <label class="form-check-label smTextSize" for="visible">Visibile al pubblico <em>(Spunta questa casella per rendere subito visibile il tuo appartamento)</em></label>
        </div>
        <hr class="mb-0">
        {{-- image --}}
        <label for="image" class="smTextSize p-1">Inserisci un'immagine</label>
        <span id="image-error" class="text-danger invalid-feedback"></span>
        <div class="p-0 d-flex">
            @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <input class="form-control rounded-0" type="file" placeholder="no file selected" name="image" id="image" accept="image/*">
        </div>
        <hr class="mt-0">
        {{-- services --}}
        <div class="p-2 d-flex flex-column justify-content-between">
            @error('services')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <span id="services-error" class="text-danger invalid-feedback"></span>
            @foreach ($services as $service)
                <div class="single-tag d-flex align-items-center">
                    <input type="checkbox" class="form-check-input my-service d-flex align-items-center m-0" name="services[]" value="{{ $service->id }}"
                        @if ($errors->any()) @checked(in_array($service->id, old('services',[])))
                        @else
                        @checked($apartment->services->contains($service->id))
                        @endif>
                    <label class="form-check-label ms-2">{{ $service->name }}</label>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end">
            @if ($route == 'user.apartments.update')
                <button type="submit" class="m-3">Modifica</button>
            @else
                <button type="submit" class="m-3">Crea</button>
            @endif
        </div>
    </form>
</div>
