@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/warrant.css') }}">
@endpush
@extends('layouts.export.template')
@section('content')
@include('hris.official_travels.warrant.excel')
@endsection