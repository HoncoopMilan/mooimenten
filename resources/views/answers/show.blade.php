<x-app-layout>
    <h1 style="font-size: 20px; font-weight:bold;">Alle antwoorden + vragen</h1>
    @foreach($questionnaire->questions as $question)
        <?php $questionQuestion = str_ireplace("%name%", $questionnaire->deceased->name, $question->question) ?>
        <h2 style="font-size: 15px; font-weight: bold; margin-top: 10px;">{{$questionQuestion}}:</h2>
        @foreach($questionnaire->answers as $answer)
            @if($question->question == $answer->question->question)
                <p>{{$answer->answer}}</p>
            @endif
        @endforeach
    @endforeach

    <h2 style="font-size: 20px; font-weight:bold;">Foto's</h2>
    @foreach($questionnaire->photos as $photo)
        <img style="width: 150px; margin-top: 10px; border: 1px solid black;" src="{{asset('storage/answers/' . $photo->img)}}" alt="">
    @endforeach
</x-app-layout>
