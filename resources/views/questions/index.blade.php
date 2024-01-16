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
    <div class="form-question">
        <?php $count = 0;?>
        @foreach($questions as $question)
        <?php $count++ ?>
        <div class="form-group" style="display:flex; align-items: center;">
            <div class="question">
                <form style="margin-top: 3px; margin-bottom: 3px;" action="{{ route('question.update',$question->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')     
                    <div class="textfield">
                        <input style="width: 600px;" type="text" name="question" id="" value="{{$question->question}}">
                    </div>
                <div class="question-buttons">
                    <div class="question-btn">
                        <button type="submit">Aanpassen</button> 
                    </div>  
                </form> 
                <div class="question-btn" style="margin-top: 3px; margin-bottom: 3px;">
                    <form class="delete-{{$count}}" action="{{ route('question.destroy', $question->id) }}" method="Post">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button class="submit-{{$count}}" style="margin-right: 25px;" type="submit">Verwijderen</button>
                </div>     
                </div>
            </div>
    </div>
    <p id="count" style="display: none">{{$count}}</p>
        @endforeach
    <script>
        const count = document.querySelector('#count');
        const questionCreate = document.querySelector('.questionCreate');
        const questionForm = document.querySelector('.questionCreateForm');

        for (let i = 1; i < (Number(count.textContent) + 1); i++) {
            let submit = document.querySelector(`.submit-${i}`);
            let deleteQuestion = document.querySelector(`.delete-${i}`);

            submit.addEventListener('click', () => {
                let sure = confirm('Als u de vraag verwijderd zal deze ook uit alle bestaande vragenlijsten worden verwijderd');
                if(sure == true){
                    deleteQuestion.submit();
                }
            });
        }

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