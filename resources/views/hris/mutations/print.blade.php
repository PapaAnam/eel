@extends('layouts.export.template')
@section('content')
@include('mutations.excel', ['lisun'=>true])
@endsection