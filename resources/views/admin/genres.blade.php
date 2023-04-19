@extends('layouts.app')

@section('title', 'Manage genres')

@section('content')
    @include('includes.genrestable')
    {{$genres->links()}}
@endsection