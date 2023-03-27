@extends('layouts.app')

@section('head')
    <script src="https://js.braintreegateway.com/web/dropin/1.34.0/js/dropin.min.js"></script>
    @vite(['resources/js/braintree.js'])
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <form  id="payment-form" method="POST" action="/checkout">
                @csrf
                <div id="dropin-container"></div>
                <input type="hidden" id="nonce" name="payment_method_nonce"/>
                <input type="submit" value="pay $10">
            
            </form> 
        </div>
    </div>
</div>



@endsection