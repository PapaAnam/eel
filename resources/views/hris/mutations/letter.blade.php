@push('css')
<link rel="stylesheet" href="{{ asset('css/bs3.min.css') }}">
@endpush
@extends('layouts.export.template')
@section('content')
@include('hris.mutations.letter_excel')
@endsection