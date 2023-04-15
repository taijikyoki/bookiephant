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
                    @if($loop->iteration % 2 === 0)
                    <br>
                    @endif
                @endforeach
            </td>    
            <td>{{$book->release_year}}</td>
            <td>{{$book->publishing_type}}</td>
        </tr>

    @endforeach
    </tbody>
</table>