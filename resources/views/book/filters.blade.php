<form action="/set_filters" method="POST">
    @csrf
    <div class="flex text-center mt-6">
        <div class = "grow min-w-[10%]">
            <label for="sortBy" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sort by</label>
            <select name="sortBy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">    
                <option value="id">ID</option>
                <option value="title">Title</option>
                <option value="release_year">Year</option>
            </select>
        </div>
        
        <div class = "grow px-1">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Book title">
        </div>

        <div class = "grow px-1 min-w-[25%]">
            <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author</label>
            <select name="author" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 select-author">
                <option value=""></option>
                @foreach ($authors as $author)
                    <option value="{{ $author->name }}">{{$author->name}}</option>
                @endforeach
            </select>
        </div>

        <div class = "grow-0 px-1">
            <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
            <input type="text" name="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Release year">
        </div>

        <div class = "grow px-1 min-w-[20%]">
            <label for="genres" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genres</label>
            <select class="select-genres-multiple block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="genres[]" multiple="multiple">
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{$genre->name}}</option>
                @endforeach
            </select>
        </div>
        
        <div class = "grow-0 px-1 mt-auto">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Filter</button>
        </div>
    </div>
</form>