@extends('layouts.app')

@section('title', 'Manage books')

@section('content')
    @include('book.filters')
    @include('includes.bookstable')
    {{$books->links()}}
@endsection