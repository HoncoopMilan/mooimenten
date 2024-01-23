<header>
    <div class="nav">
        <a href="/"><img class="header_logo" src="{{asset('img/logo.png')}}" alt="logo.png"></a>
        @if(Auth::check())
            <div class="nav-button">
                <a href="{{route('questionnaire.index')}}">Vragenlijsten</a>
            </div>
            @if(Auth::user()->admin == 1)
                <div class="nav-button">
                    <a href="{{route('question.dashboard')}}">Vragen</a>
                </div>
                <div class="nav-button">
                    <a href="{{route('companies.index')}}">Bedrijven</a>
                </div>
                <div class="nav-button">
                    <a href="{{route('answer.index')}}">Antwoorden</a>
                </div>
            @endif
        @endif
        <div class="login-nav">
                @if(Auth::check())
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Uitloggen</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{route('login')}}">Inloggen</a>
            @endif
        </div>
    </div>
</header>
