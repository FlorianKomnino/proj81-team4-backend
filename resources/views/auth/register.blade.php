@extends('layouts.app')

@section('head')
    @vite(['resources/js/userRegisterFormValidations.js'])
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrati') }}</div>

                    <div class="card-body">
                        <form method="POST" id="form" action="{{ route('register') }}">
                            @csrf

                            {{-- email --}}
                            <span id="email-error" class="text-danger invalid-feedback">L'email è necessaria</span>
                            <div class="mb-4 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email: * </label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- password --}}
                            <span id="password-error" class="text-danger invalid-feedback">La password è necessaria</span>
                            <div class="mb-4 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password: *</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                         autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- password confirm --}}
                            <span id="confirmPassword-error" class="text-danger invalid-feedback">Conferma la tua password</span>
                            <div class="mb-4 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Conferma 
                                    password: *</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation"  autocomplete="new-password">
                                </div>
                            </div>

                            {{-- name --}}
                            <span id="name-error" class="text-danger invalid-feedback">Inserisci almeno 3 caratteri</span>
                            <div class="mb-4 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nome: </label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- surname --}}
                            <span id="surname-error" class="text-danger invalid-feedback">Inserisci almeno 3 caratteri</span>
                            <div class="mb-4 row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">Cognome:</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text"
                                        class="form-control @error('surname') is-invalid @enderror" name="surname"
                                        value="{{ old('surname') }}" autocomplete="surname" autofocus>

                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- birth_date --}}
                            <span id="birth_date-error" class="text-danger invalid-feedback">Seleziona una data</span>
                            <div class="mb-4 row">
                                <label for="birth_date" class="col-md-4 col-form-label text-md-right">Data di nascita:</label>

                                <div class="col-md-6">
                                    <input id="birth_date" type="date"
                                        class="form-control @error('birth_date') is-invalid @enderror" name="birth_date"
                                        value="{{ old('birth_date') }}" autocomplete="birth_date" autofocus>

                                    @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <p class=" me-4 text-end text-secondary fst-italic">i campi contrassegnati da * sono obbligatori</p>
                </div>
            </div>
        </div>
    </div>
@endsection
