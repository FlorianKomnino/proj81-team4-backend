<div id="container-form" class="container my-4">
    <form action="{{ route($route, $apartment->slug) }}" id="form" class="m-auto" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method($formMethod)

        <h2 class="text-center m-0 p-3 fw-bold">
            {{ $formMethod === 'POST' ? 'Create a new apartment' : "Edit the apartment '$apartment->title'" }}
        </h2>
        <div class="d-flex flex-column p-2">
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="title">Titolo:</label>
            <span id="title-error" class="text-danger invalid-feedback">Il Titolo deve essere di almeno due caratteri</span>
            <textarea id="title" class="p-0 border-0" placeholder="Inserisci un titolo descrittivo per l'appartamento" name="title">{{ old('title', $apartment->title) }}</textarea>
        </div>
        <hr>
        <div class="d-flex flex-column p-2">
            @error('rooms')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="rooms">Numero di stanze:</label>
            <span id="rooms-error" class="text-danger invalid-feedback">Il n° di stanze deve essere un valore numerico compreso fra 1 e 20</span>
            <input id="rooms" type="number" value="{{ old('rooms', $apartment->rooms) }}" class="p-0 border-0"
                placeholder="Numero di stanze" name="rooms">
        </div>
        <hr>
        <div class="d-flex flex-column p-2">
            @error('beds')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="beds">Numero di letti:</label>
            <span id="beds-error" class="text-danger invalid-feedback">Il n° di letti deve essere un valore numerico compreso fra 1 e 40</span>
            <input id="beds" type="number" value="{{ old('beds', $apartment->beds) }}" class="p-0 border-0"
                placeholder="Numero di letti" name="beds">
        </div>
        <hr>
        <div class="d-flex flex-column p-2">
            @error('bathrooms')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="bathrooms">Numero di bagni:</label>
            <span id="bathrooms-error" class="text-danger invalid-feedback">Il n° di bagni deve essere un valore numerico compreso fra 1 e 10</span>
            <input id="bathrooms" type="number" value="{{ old('bathrooms', $apartment->bathrooms) }}" class="p-0 border-0"
                placeholder="Numero di Bagni" name="bathrooms">
        </div>
        <hr>
        <div class="d-flex flex-column p-2">
            @error('square_meters')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="square_meters">Metri quadrati:</label>
            <span id="square_meters-error" class="text-danger invalid-feedback">I metri quadri devono avere un valore numerico compreso fra 4 e 250m<sup>2</sup></span>
            <input id="square_meters" type="number" value="{{ old('square_meters', $apartment->square_meters) }}" class="p-0 border-0"
                placeholder="Metri quadrati" name="square_meters">
        </div>
        <hr>
        <div class="d-flex flex-column p-2">
            @error('address')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            @if (session('message'))
                <p class="text-danger">{{session('message')}}</p>
            @endif
            <label for="address">Indirizzo dell'appartamento:</label>
            <span id="address-error" class="text-danger invalid-feedback">L'indirizzo deve essere di almeno 3 caratteri</span>
            <input  id="address" type="text" value="{{ old('address', $apartment->address) }}" class="p-0 border-0"
                placeholder="Indirizzo dell'appartamento" name="address">
        </div>
        <hr class="mb-0">
        <div class="d-flex mt-1 p-2">
            <input class="form-check-input me-2" type="checkbox" value="1" {{ old('visible', $apartment->visible) ? 'checked' : '' }} name="visible" id="visible">
            <label class="form-check-label" for="visible">Visibile al pubblico <em>(Spunta questa casella per rendere subito visibile il tuo appartamento)</em></label>
        </div>
        <hr class="mb-0">

        <label for="image" class=" p-1">Inserisci un'immagine</label>

        <div class="p-0 d-flex">
            @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <input class="form-control rounded-0" type="file" placeholder="no file selected" name="image" id="image" accept="image/*">
        </div>
        
        <hr class="mt-0">
    
        <div class="p-2 d-flex flex-column justify-content-between">
            @error('services')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <span id="services-error" class="text-danger invalid-feedback">Almeno un servizio deve essere selezionato</span>
            @foreach ($services as $service)
                <div class="single-tag d-flex align-items-center">
                    <input type="checkbox" class="form-check-input my-service" name="services[]" value="{{ $service->id }}"
                        @if ($errors->any()) @checked(in_array($service->id, old('services',[])))
                        @else
                        @checked($apartment->services->contains($service->id))
                        @endif>
                    <label class="form-check-label ms-2">{{ $service->name }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary m-2">Submit</button>
    </form>
</div>
