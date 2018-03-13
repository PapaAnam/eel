@push('css')
<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
@endpush
@extends('layouts.export.template')
@section('content')
@include('hris.mutations.letter_excel')
@endsection