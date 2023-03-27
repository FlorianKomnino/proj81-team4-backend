@extends('layouts.app')

@section('head')
    <script src="https://js.braintreegateway.com/web/dropin/1.35.0/js/dropin.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.91.0/js/client.min.js"></script>

    @vite(['resources/js/braintree.js'])
@endsection

@section('content')

<form id="payment-form" method="POST" action="/checkout">
    
    <div id="dropin-container"></div>
    <input type="hidden" id="nonce" name="payment_method_nonce"/>
    <input type="submit" value="pay $10">

</form>

@endsection