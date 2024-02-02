<x-app-layout>
    <div class="answer-title">
        <h1 style="font-size: 20px; font-weight:bold;">Alle antwoorden + vragen</h1>
    </div>
    <div class="answers-container">
        <div class="sub-container">
            @for($i = 0; $i <= $latestPerson; $i++)

                <div class="person">
                <div class="answer-h1">
                    <h1>Antwoord: {{($i + 1)}}</h1>
                </div>
                
                @foreach($questionnaire->answers as $answer)
                
                    @if($answer->person == $i)
                                    <?php $questionQuestion = str_ireplace("%name%", $questionnaire->deceased->name, $answer->question->question) ?>
                                    <h2 style="font-size: 15px; font-weight: bold; margin-top: 10px;">{{$questionQuestion}}:</h2>
                                    <p>{{$answer->answer}}</p>       
                            @endif
                
                            
                @endforeach
                <h2 style="font-size: 20px; font-weight:bold;">Foto's</h2>
                @foreach($questionnaire->photos as $photo)
                    @if($photo->person == $i)
                    <img style="width: 150px; margin-top: 10px; margin-bottom:25px;" src="{{asset('storage/answers/' . $photo->img)}}" alt="">
                    @endif
                @endforeach
                </div>
            @endfor
        </div>
    </div>
    
    </div>
    
</x-app-layout>
