@extends('layouts.app')

@section('title', 'Create author')

@section('content')


<div class = "w-2/6">
<div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
    <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
    <div class="mb-4">
        <h1 class="text-2xl font-bold underline decoration-gray-400">
        Add author to registry
        </h1>
    </div>

    <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center" role="alert">
                    {{ $error }}
                </div>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="/admin/create_author">
        @csrf
        <div>
            <label class="block text-sm font-bold text-gray-700" for="name">
            Name
            </label>

            <input
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            type="text" name="name" placeholder="" />
        </div>

        <div class="flex items-center justify-start mt-4 gap-x-2">
            <button type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Add
            </button>
            <a href="{{route('admin-authors')}}"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Cancel
            </a>
        </div>
        </form>
    </div>
    </div>
</div>
</div>

@endsection