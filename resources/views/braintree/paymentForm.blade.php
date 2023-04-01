@extends('layouts.app')

@section('head')
    <script src="https://js.braintreegateway.com/web/dropin/1.34.0/js/dropin.min.js"></script>
    @vite(['resources/js/braintree.js'])
@endsection

@section('content')
    <div id="payment-container" class="container">
        <div id="braintree-loader" class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        <div class="row justify-content-center">
            <div class="col-6">
                <form  id="payment-form" method="POST" action="{{route('checkout', [$sponsorship, $apartment])}}">
                    @csrf
                    <div id="dropin-container"></div>
                    <input type="hidden" id="nonce" name="payment_method_nonce"/>
                    <input type="hidden" id="nonce" name="device_data_element"/>
                    <input id="payment-submit" class="d-none" type="submit" value="paga &euro;{{$sponsorship->price}}">
                </form> 
            </div>
        </div>
    </div>
@endsection