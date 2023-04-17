<div class = "grid grid-cols-2 gap-2 sticky top-0 bg-white">
    <div class = "grid grid-cols-4 gap-4 px-3">

        <div>
            <a href="/">Homepage</a>
        </div>
        
        @role('admin')
        <div>
            <a href="/admin/books">Manage Books</a>
        </div>
        <div>
            <a href="/admin/authors">Manage Authors</a>
        </div>
        <div>
            <a href="/admin/genres">Manage Genres</a>
        </div>
        @endrole
    </div>
    
    <div class="grid grid-cols-1 gap-1 px-3 text-right">
        <div>
            @auth
                <label>{{auth()->user()->name}}</label>
                <a href="/logout">Logout</a>
            @endauth
            @guest
                <a href="/signup">Sign up</a>
                <a href="/signin">Sign in</a>                
            @endguest
        </div>
    </div>
</div>
