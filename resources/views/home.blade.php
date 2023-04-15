@extends('layouts.app')

@section('title', "Book's Registry")

@section('content')
    @include('includes.filters')
    @include('includes.bookstable')
    {{$books->links()}}
@endsection