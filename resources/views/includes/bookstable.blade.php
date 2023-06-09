@if (session()->has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        {{session()->remove('success')}}
    </div>
@endif

@role('admin')
@if(session()->has('administrate'))
<a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded" href="{{route('admin-create-book')}}">
    Add book
</a>
@endif
@endrole

<table class="border-collapse table-fixed w-full text-sm text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>Book</th>
            <th>Author</th>
            <th>Genres</th>
            <th>Release Year</th>
            <th>Type</th>
            @role('admin')
            @if(session()->has('administrate'))
                <th>Created at</th>
                <th></th>
            @endif
            @endrole
        </tr>
    </thead>
    <tbody>
    @foreach ($books->sortBy($sortBy) as $book)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$book->title}}</td>
            <td>{{$book->author->name}}</td>
            <td>
                @foreach ($book->genres()->get()->pluck('name') as $genre)
                    @if($loop->last)
                        {{$genre}}
                        @break
                    @endif
                    {{$genre}},
                    @if($loop->iteration % 2 === 0)
                        <br>
                    @endif
                @endforeach
            </td>    
            <td>{{$book->release_year}}</td>
            <td>{{$book->publishing_type}}</td>
            @role('admin')
            @if(session()->has('administrate'))
                <td>{{date('d.m.Y', strtotime($book->created_at))}}</td>
                <td class = "flex">
                    <a href="{{route('admin-edit-book', $book->id)}}" class="text-indigo-600 hover:text-indigo-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    </a>
    
                    <a href="{{route('show-book', $book->id)}}" class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    </a>
                    
                    <form action="{{ route('admin-delete-book', $book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600 hover:text-red-800"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    </form>
                </td>
            @endif
            @endrole
            
            @if(!session()->has('administrate'))
            <td class = "flex">
                <a href="{{route('show-book', $book->id)}}" class="text-gray-600 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                </a>
            </td>
            @endif
        </tr>

    @endforeach
    </tbody>
</table>