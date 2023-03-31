@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-2">
            <a href="{{ route('user.apartments.index' ) }}">Torna agli appartamenti</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <h1 class="text-success">
                Transazione avvenuta con successo
            </h1>
        </div>
    </div>
</div>
@endsection