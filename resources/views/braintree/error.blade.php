@extends('layouts.app')

@section('head')
    @vite(['resources/js/braintree.js'])
@endsection

@section('content')


<div>
    <h1 class="text-danger">
        Qualcosa è andato storto! Torna al form di pagamento per riprovare.
    </h1>
</div>


@endsection