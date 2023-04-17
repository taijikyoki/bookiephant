@extends('layouts.app')

@section('title', 'Manage books')

@section('content')
    @include('book.filters')
    <a href="{{route('admin-create-book')}}">Create book!</a>
    @include('includes.bookstable')
    {{$books->links()}}
@endsection