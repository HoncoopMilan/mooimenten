<x-app-layout>
    <div class="question-info">
        <h2>Vragen overzicht</h2>
        <p>Om een vraag aan te maken zet waar de naam van de overledenen %name% neer, zodat de naam daar komt.</p>
    </div>
    <div class="question-create">
        <form style="margin: 0px;" action="{{ route('question.storeQuestion') }}" method="POST" enctype="multipart/form-data">
            @csrf  
            <input style="width: 600px" type="text" name="question" id="" placeholder="Typ hier uw vraag">
            <div class="question-btn">
                <button type="submit">Submit</button> 
            </div>
        </form>
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
                <div class="question-btn">
                    <form style="margin-top: 3px; margin-bottom: 3px;" action="{{ route('question.destroy', $question->id) }}" method="Post">
                        @csrf
                        @method('DELETE')
                        <button style="margin-left: 5px;" type="submit">Verwijderen</button>
                    </form>
                </div>     
                </div>
            </div>
    </div>
        @endforeach
    </div> 
            <form style="margin-top: 3px; margin-bottom: 3px;" action="{{ route('question.update',$question->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')     
                <input style="width: 300px;" type="text" name="question" id="" value="{{$question->question}}">
                <button type="submit">Aanpassen</button> 
            </form>   
            <form class="delete-{{$count}}" style="margin-top: 3px; margin-bottom: 3px;" action="{{ route('question.destroy', $question->id) }}" method="Post">
                @csrf
                @method('DELETE')
            </form>
            <button class="submit-{{$count}}" style="margin-left: 5px;">Verwijderen</button>
        </div>
        <p id="count" style="display: none">{{$count}}</p>
    </div>
    <script>
        const count = document.querySelector('#count');

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
    </script>
</x-app-layout>