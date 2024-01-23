<x-app-layout>
    <div class="question-create">
            <form style="margin: 0px" class="questionCreateForm" action="{{ route('question.storeQuestion') }}" method="POST" enctype="multipart/form-data">
                @csrf  
                <input style="display: none" type="text" name="question" id="">
            </form>
        <div class="questionnaire-btn" style="margin-top: 15px;">
            <button class="questionCreate" style="margin-left: 5px;">Vraag aanmaken</button>
        </div>
    </div>
    <div class="form-question" style="padding-bottom: 50px;">
        @foreach($questions as $question)
        <div class="form-group" style="display:flex; align-items: center;">
            <div class="question">
                <form style="margin-top: 3px; margin-bottom: 3px;" action="{{ route('question.update',$question->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')     
                    <div class="textfield">
                        <input style="width: 600px;" class="input-question" type="text" name="question" id="" value="{{$question->question}}">
                    </div>
                <div class="question-buttons">
                    <div class="question-btn">
                        <button type="submit">Aanpassen</button> 
                    </div>  
                </form> 
                <div class="question-btn" style="margin-top: 3px; margin-bottom: 3px;">
                    <form action="{{ route('question.destroy', $question->id) }}" method="Post">
                        @csrf
                        @method('DELETE')
                        <button style="margin-right: 25px;" type="submit" onclick="return confirm('Als u de vraag verwijderd zal deze ook uit alle bestaande vragenlijsten worden verwijderd');">Verwijderen</button>
                    </form>
                </div>     
                </div>
            </div>
    </div>
        @endforeach
    <script>
        const count = document.querySelector('#count');
        const questionCreate = document.querySelector('.questionCreate');
        const questionForm = document.querySelector('.questionCreateForm');

        questionCreate.addEventListener('click', () => {
            let questionName = prompt('Naam van de vraag. Gebruik %name% voor de persoon zijn naam');
            let questionInput = questionForm.querySelector('input[name="question"]');
            questionInput.value = questionName;

            if(questionName != null){
                questionForm.submit();
            }
        });
    </script>
</x-app-layout>