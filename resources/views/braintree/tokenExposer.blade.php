@extends('layouts.app')

@section('head')
    <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
    @vite(['resources/js/braintree.js'])
@endsection

@section('content')



<form id="checkout" method="POST" action="/checkout">
    
    <div id="dropin-container"></div>
<div id="payment-form"></div>
<input type="submit" value="pay $10">

</form>


@endsection
