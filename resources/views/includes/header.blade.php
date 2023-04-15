<div class = "grid grid-cols-3 gap-3">
    <div class = "grid grid-cols-3 gap-3">
        <div class="text-center">
            <a href="/">Homepage</a>
        </div>
        
        @role('admin')
        <div>
            <a href="/admin">Administrate</a>
        </div>
        @endrole
    </div>

    <div></div>
    
    <div class="grid grid-cols-3 gap-3">
        <div></div>

        <div></div>
        
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
