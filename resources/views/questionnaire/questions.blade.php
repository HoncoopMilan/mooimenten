<x-app-layout>
    <h1>Kies de vragen die je wilt zien</h1>
    @if (\Session::has('error'))
        <p style="color: red">{!! \Session::get('error') !!}</p>
    @endif
    @if(!isset($questionEntered))
    <form class="formproject" action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            @foreach ($questions as $question)
            <div class="form-group" >
                <?php $questionQuestion = str_ireplace("%name%", $questionnaire->deceased->name, $question->question) ?>
                <input type="checkbox" id="" name="questions[{{$question->id}}]" value="{{$question->id}}">
                <label for="question{{$question->id}}">{{$questionQuestion}}</label>
            </div>
            @endforeach

        <input type="hidden" name="questionnaire_id" value="{{$questionnaire->id}}">
        <button type="submit">Volgende</button>
    </form>
    @else
    <form class="formproject" action="{{ route('questions.update',$questionnaire->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @foreach ($questions as $question)
            <div class="form-group" >
                <?php $questionQuestion = str_ireplace("%name%", $questionnaire->deceased->name, $question->question) ?>
                <input type="checkbox" id="" name="questions[{{$question->id}}]" value="{{$question->id}}" {{ $questionnaire->questions->contains($question) ? 'checked' : '' }}>
                <label for="question{{$question->id}}">{{$questionQuestion}}</label>
            </div>
            @endforeach

        <input type="hidden" name="questionnaire_id" value="{{$questionnaire->id}}">
        <button type="submit" name="action" value="previous">Vorige</button>
        <button type="submit" name="action" value="next">Volgende</button>
    </form>
    @endif
</x-app-layout>