@extends('master')
@section('sidebar')
    @parent
    <p>This is SideBar</p>
@endsection

@section('component')
    <p>This is component</p>
@php
    echo "1"
@endphp
@endsection