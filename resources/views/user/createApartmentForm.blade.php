@extends('layouts.app')

@section('content')
@include('user.partials.createEditPartialForm',["route" => "user.apartments.store"  , "formMethod" => "POST" ])
@endsection