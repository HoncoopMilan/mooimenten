<x-app-layout>
    <div class="container">
        <div class="sub-container">
            <div class="overledene">
                <img style="width: 150px; height: 150px; object-fit: cover; border-top-left-radius: 5px; border-bottom-left-radius: 5px;" src="{{asset('storage/' . $questionnaire->deceased->img)}}" alt="">
                <div class="overledene-txt">
                    <h1 style="font-size: 20px;">{{$questionnaire->deceased->name}}</h1>
                    <div class="geboorte">
                        <img style="width: 15px; height: 15px;" src="{{asset('img/star.png')}}" alt="">
                        <p style="font-size: 14px; margin-left: 4px;">{{$questionnaire->deceased->date_of_birth}}</p>
                    </div>
                    <div class="sterf-datum">
                        <img style="width: 15px; height: 15px;" src="{{asset('img/cross.png')}}" alt="">
                        <p style="font-size: 14px; margin-left: 4px;">{{$questionnaire->deceased->date_of_death}}</p>
                    </div>
                    <div class="adres">
                        <p>{{$questionnaire->deceased->adress}}</p>
                        <p>{{$questionnaire->deceased->city}}</p>
                    </div>
                </div>
            </div>
            {{-- <h2 style="font-size: 20px">Laat al uw herinneringen achter</h2> --}}
            <form action="">
                @csrf
                <div class="form-container">
                    @foreach($questionnaire->questions as $question)
                    <div class="form-group">
                        <?php $questionQuestion = str_ireplace("%name%", $questionnaire->deceased->name, $question->question) ?>
                        <label class="custom-label" >{{$questionQuestion}}</label>
                       <textarea name="" id="custom-textarea"></textarea>
                    </div>
                    @endforeach
                    <div class="form-image">
                        <div class="label">
                            <label for="">Voeg foto's in</label>
                            <label for="">0/3</label>
                        </div>
                        <label class="custom-file-upload">
                            <input type="file"/>
                            <img src="{{asset('img/add-image.png')}}" alt="">
                        </label>
                    </div>
                    <button type="submit" class="submit-btn">Verstuur uw herinneringen</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>