@extends('layouts.app')

@section('title', 'Book!')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show book</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 pt-2">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $book->title }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 pt-2">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $book->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 pt-2">
            <div class="form-group">
                <strong>Author:</strong>
                {{ $book->author->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 pt-2">
            <div class="form-group">
                <strong>Release year:</strong>
                {{ $book->release_year }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 pt-2">
            <div class="form-group">
                <strong>Type:</strong>
                {{ $book->publishing_type }}
            </div>
        </div>
        <div class="pull-right pt-2">
            <a href="{{route('home')}}"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"> Back</a>
        </div>
    </div>
@endsection