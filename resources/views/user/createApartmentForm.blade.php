@extends('layouts.app')

@section('head')
@vite(['resources/js/clientValidations.js'])
@endsection

@section('content')
@include('user.partials.createEditPartialForm',["route" => "user.apartments.store"  , "formMethod" => "POST" ])
@endsection