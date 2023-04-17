@extends('layouts.app')

@section('title', "Book's Registry")

@section('content')
    @include('book.filters')
    @include('includes.bookstable')
    {{$books->links()}}
@endsection