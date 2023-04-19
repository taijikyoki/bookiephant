@extends('layouts.app')

@section('title', 'Manage authors')

@section('content')
    @include('includes.authorstable')
    {{$authors->links()}}
@endsection