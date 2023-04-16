@extends('layouts.app')

@section('title', 'Manage books')

@section('content')
    @include('includes.filters')
    @include('includes.bookstable')
    {{$books->links()}}
@endsection