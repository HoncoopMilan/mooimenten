<header>
    <div class="nav" style="align-items: center;">
        <a href="/"><img class="header_logo" src="{{asset('img/logo.png')}}" alt="logo.png"></a>
        <nav x-data="{ open: false }" class="">
            @if(Auth::check())
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Uitloggen</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endif
        </nav>   
    </div>
</header>
