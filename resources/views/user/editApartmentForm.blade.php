@extends('layouts.app')

@section('content')
@include('user.partials.createEditPartialForm',["route" => "user.apartments.update"  , "formMethod" => "PUT" ])
@endsection