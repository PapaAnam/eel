@extends('layouts.export.template')
@section('content')
@include('hris.employees.export.excel', ['lisun'=>true])
@endsection