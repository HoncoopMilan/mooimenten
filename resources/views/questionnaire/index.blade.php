<x-app-layout>
    <div class="questionnaire-container">
        <div class="questionnaire-sub-container">
            <div class="section-1">
                <div class="questionnaire-btn">
                    <form class="questionnaireCreateForm" action="{{ route('questionnaire.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf  
                        <input style="display: none" type="text" name="name" id="">
                    </form>
                    <button class="questionnaireCreate" style="margin-left: 5px;">Vragenlijst aanmaken</button>
                </div>
                @if(Auth::user()->admin == 1)
                    <div class="questionnaire-btn">
                        <a href="{{route('question.dashboard')}}">Vragen bekijken</a>
                    </div>
                @endif
                <form action="">
                    <input style="width: 400px;" type="search" id="searchInput" class="search-bar" placeholder="Zoeken..." name="search" value="{{request('search')}}">
                </form>
            </div>            
            
            @if (\Session::has('error'))
                <p style="color: red">{!! \Session::get('error') !!}</p>
            @elseif(\Session::has('succes'))
                <p style="color: green">{!! \Session::get('succes') !!}</p>
            @endif
            <div class="questonnaire-container">
                @foreach ($questionnaires as $questionnaire)
                    <div class="questionnaire">
                        <a class="edit" href="{{ route('deceased.questionnaire', $questionnaire->name) }}"><img src="{{ asset('img/edit.png')}}" alt=""></a>
                        <div class="questionnaire-info">
                            <a style="margin-bottom: 10px;" href="{{ route('deceased.questionnaire', $questionnaire->name) }}"><strong>{{$questionnaire->name}}</strong></a></td>
                            <div class="document">
                                <img style="margin-right: 5px" src="{{ asset('img/document.png')}}" alt="">
                                <p><strong>{{$questionnaire->completed_times}}x</strong> ingevuld</p>
                            </div>
                            <div >
                                <form action="{{ route('questionnaire.destroy', $questionnaire->id) }}" method="Post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="questionnaire-delete-btn" type="submit" onclick="return confirm('Weet u zeker dat je deze vragenlijst wilt verwijderen?');">Verwijderen</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>            
        const questionnaireCreate = document.querySelector('.questionnaireCreate');
        const questionnaireForm = document.querySelector('.questionnaireCreateForm');

        questionnaireCreate.addEventListener('click', () => {
            let questionnaireName = prompt('Naam van de vragenlijst');
            let nameInput = questionnaireForm.querySelector('input[name="name"]');
            nameInput.value = questionnaireName;

            if(questionnaireName != null){
                questionnaireForm.submit();
            }
        });
      </script>

      @livewireScripts
</x-app-layout>