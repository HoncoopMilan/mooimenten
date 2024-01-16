<x-app-layout>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <li> {{ $error }}</li>
        @endforeach
    @endif
    <div class="show-container">
        <div class="show-sub-container">
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
            <form action="{{ route('answer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-container">
                    @if (\Session::has('questionError'))
                        <p style="color: red">{!! \Session::get('questionError') !!}</p>
                    @endif
                    @foreach($questionnaire->questions as $question)
                    <div class="form-group">
                        <?php $questionQuestion = str_ireplace("%name%", $questionnaire->deceased->name, $question->question) ?>
                        <label class="custom-label" >{{$questionQuestion}}</label>
                       <textarea name="questions[{{$question->id}}]" id="custom-textarea"></textarea>
                    </div>
                    @endforeach
                    <div class="form-image">
                        <p id="maxImagesError" style="color:red;"></p>
                        @if (\Session::has('imgError'))
                            <p style="color: red">{!! \Session::get('imgError') !!}</p>
                        @endif
                        <div class="label">
                            <label for="">Voeg foto's in</label>
                            <label id="countImages" for="">Maximaal 3 foto's</label>
                        </div>
                        <label class="custom-file-upload">
                            <input name="img[]" type="file" multiple style="display:none" accept="image/*" onchange="checkImageCount(this)"/>
                            <img id="img" src="{{asset('img/add-image.png')}}" alt="">
                            <div id="image-preview-container"></div>
                        </label>
                    </div>
                    <input type="hidden" name="questionnaire_id" value="{{$questionnaire->id}}" id="">
                    <button type="submit" class="submit-btn">Verstuur uw herinneringen</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function checkImageCount(input) {
            let imageErrorEl = document.getElementById('maxImagesError');

            if (input.files.length > 3) {
                imageErrorEl.innerText = "Je kunt maximaal 3 foto's selecteren";
            }else{
                imageErrorEl.innerText = "";
                displaySelectedImages(input)
            }
        }

        function displaySelectedImages(input) {
            var previewContainer = document.getElementById('image-preview-container');
            let previewImageEl = document.getElementById('img');
            let countImagesEl = document.getElementById('countImages');

    
            if (input.files) {
                previewContainer.innerHTML = ''; // Clear previous previews
                for (var i = 0; i < input.files.length; i++) {
                    var reader = new FileReader();
    
                    reader.onload = function (e) {
                        var imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.alt = 'Selected Image';
                        previewImageEl.style.display = 'none';
                        previewContainer.appendChild(imgElement);
                    };
    
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>
</x-app-layout>