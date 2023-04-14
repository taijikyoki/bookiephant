@extends('layouts.app')

@section('title', "Book's Registry")

@section('content')
    <form action="/set_filters" method="POST">
        @csrf
        <div class="flex text-center">
            <div class = "w=1/5">
                <label for="sortBy" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sort by</label>
                <select name="sortBy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">    
                    <option value="id">Position</option>
                    <option value="title">Title</option>
                    <option value="release_year">Year</option>
                    <option value="author">Author</option>
                </select>
            </div>
            
            <div class = "w=1/5 px-1">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Book title">
            </div>

            <div class = "w=1/5 px-1">
                <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author</label>
                <input type="text" name="author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Author">
            </div>

            <div class = "w=1/5 px-1">
                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                <input type="text" name="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Release year">
            </div>
            
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 px-1">Filter</button>
        </div>
    </form>

    <table class="border-collapse table-fixed w-full text-sm text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Book</th>
                <th>Author</th>
                <th>Genres</th>
                <th>Release Year</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($books->sortBy($sortBy) as $book)
            <tr>
                <td>{{$book->id}}</td>
                <td>{{$book->title}}</td>
                <td>{{$book->author->name}}</td>
                <td>
                    @foreach ($book->genres()->get()->pluck('name') as $genre)
                        @if($loop->last)
                            {{$genre}}
                            @break
                        @endif
                        {{$genre}},
                    @endforeach
                </td>    
                <td>{{$book->release_year}}</td>
                <td>{{$book->publishing_type}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$books->links()}}
@endsection