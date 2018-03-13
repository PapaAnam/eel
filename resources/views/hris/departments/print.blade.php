@extends('layouts.export.template')
@section('content')
@include('hris.departments.excel', ['lisun'=>true])
@endsection