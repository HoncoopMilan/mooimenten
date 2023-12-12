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
                    <a href="javascript:void(0);" onclick="openModal()">Maak een vragenlijst aan</a>
                </div>
                <div class="questionnaire-search">
                    <input type="text" id="searchInput" class="search-bar" placeholder="Zoeken...">
                    <button class="search-btn" onclick="search()"></button>
                </div>
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
                            {{-- <div class="document-btn">
                                <a href="">Maak word document</a>
                            </div>                       --}}
                        </div>
                    </div>
                @endforeach
            </div>
            <form action="{{ route('questionnaire.store') }}" method="POST" enctype="multipart/form-data">
                @csrf  
                <input type="text" name="name" id="">
                <button type="submit">Submit</button> 
            </form>
        </div>
    </div>
    <script>
        // Haal de modal op
        var modal = document.getElementById('myModal');
      
        // Haal de knop op die de modal opent
        var btn = document.querySelector('.questionnaire-btn a');
      
        // Haal het kruisje op om de modal te sluiten
        var span = document.querySelector('.close');

        var questionnaireContainer = document.querySelector('.questionnaire-container');
      
        btn.onclick = function() {
            modal.style.display = 'block';
            questionnaireContainer.classList.add('dark-background');
        }

        span.onclick = function() {
            modal.style.display = 'none';
            questionnaireContainer.classList.remove('dark-background');
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
                questionnaireContainer.classList.remove('dark-background');
            }
        }
        function closeModal() {
            modal.style.display = 'none';
            questionnaireContainer.classList.remove('dark-background');
        }
        function openModal() {
            modal.style.display = 'block';
            questionnaireContainer.classList.add('dark-background');
        }
      </script>
</x-app-layout>