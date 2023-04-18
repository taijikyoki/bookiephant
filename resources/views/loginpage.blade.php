@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
    <div class="w-full max-w-xs">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 text-center" role="alert">
                {{$error}}
            </div>
            @endforeach
        @endif
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method = "POST" action="do_login">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
            Email
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="email" type="text" placeholder="email" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            Password
            </label>
            <input class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="pwd" type="password" placeholder="******************" required>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Sign In
            </button>
        </div>
        </form>
    </div>
@endsection



