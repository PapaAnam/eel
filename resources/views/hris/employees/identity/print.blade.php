@extends('layouts.export.template')
@section('content')
@include('hris.employees.identity.excel', ['lisun'=>true])
@endsection
