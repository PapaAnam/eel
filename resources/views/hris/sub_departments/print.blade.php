@extends('layouts.export.template')
@section('content')
@include('hris.sub_departments.excel', ['lisun'=>true])
@endsection