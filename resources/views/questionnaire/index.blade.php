<x-app-layout>
    <div class="questionnaire-container">
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">
                    <img class="close-img" src="{{ asset('img/close.png')}}" alt="">
                </span>
                <p class="questionnaire-name">Vul de naam van de vragenlijst in</p>
                <form class="questionnaire-form" id="questionnaireForm" action="{{ route('questionnaire.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-flex">
                        <input type="text" name="name" id="questionnaireName">
                        <button style="background-color: #6C7C79" class="questionnaire-make-btn" type="submit">Maken</button> 
                    </div>  
                </form>
            </div>
        </div>
          
        <div class="questionnaire-sub-container">
            <div class="section-1">
                <div class="questionnaire-btn">
                    {{-- Pop up maken: --}}
                    {{-- <a href="javascript:void(0);" onclick="openModal()">Vragenlijst aanmaken</a> --}}
                    <form class="questionnaireCreateForm" action="{{ route('questionnaire.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf  
                        <input style="display: none" type="text" name="name" id="">
                    </form>
                    <button class="questionnaireCreate" style="margin-left: 5px;">Vragenlijst aanmaken</button>
                </div>
                @if(Auth::user()->admin == 1)
                    <div class="questionnaire-btn">
                        {{-- Pop up maken: --}}
                        <a href="{{route('question.dashboard')}}">Vragen bekijken</a>
                    </div>
                @endif
                
                @livewire('SearchBarQuestionnaire', ['questionnaires' => $questionnaires])
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
        
        // // Haal de modal op
        // var modal = document.getElementById('myModal');
      
        // // Haal de knop op die de modal opent
        // // var btn = document.querySelector('.questionnaire-btn a');
      
        // // Haal het kruisje op om de modal te sluiten
        // var span = document.querySelector('.close');

        // var questionnaireContainer = document.querySelector('.questionnaire-container');
      
        // btn.onclick = function() {
        //     modal.style.display = 'block';
        //     questionnaireContainer.classList.add('dark-background');
        // }

        // span.onclick = function() {
        //     modal.style.display = 'none';
        //     questionnaireContainer.classList.remove('dark-background');
        // }

        // window.onclick = function(event) {
        //     if (event.target == modal) {
        //         modal.style.display = 'none';
        //         questionnaireContainer.classList.remove('dark-background');
        //     }
        // }
        // function closeModal() {
        //     modal.style.display = 'none';
        //     questionnaireContainer.classList.remove('dark-background');
        // }
        // function openModal() {
        //     modal.style.display = 'block';
        //     questionnaireContainer.classList.add('dark-background');
        // }
      </script>

      @livewireScripts
</x-app-layout>