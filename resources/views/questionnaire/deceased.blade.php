<x-app-layout>
    @php
        $defaultExpire = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', '2024-01-24 16:00:00');
    @endphp
    <div class="deceased-container">
        <div class="deceased-sub-container">
            <div class="deceased-sub-sub-container">
                <h1 style="font-size: 20px; margin-bottom: 20px; margin-top: 40px;">Vul hieronder de gegevens in van de overledene</h1>
                @if( !isset($deceased))
                    <form class="formproject" action="{{ route('deceased.store', ['questionnaireName1' => $questionnaire->name]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-input-questionnaire">
                            <strong>Naam</strong>
                            <input type="text" name="name" placeholder="Naam">
                            @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Stad</strong>
                            <input type="text" name="city" placeholder="Stad">
                            @error('city')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Postcode</strong>
                            <input type="text" name="zipcode" placeholder="Bijv. 1234 AB">
                            @error('adress')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Straatnaam + huisnummer</strong>
                            <input type="text" name="adress" placeholder="Bijv. Mooiestraat 12">
                            @error('adress')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Geboortedatum</strong>
                            <input type="date" name="date_of_birth">
                            @error('date_of_birth')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror           
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Sterfdatum</strong>
                            <input type="date" name="date_of_death">
                            @error('date_of_death')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <label for="expire">Afsluitdatum</label>
                            <input type="datetime-local" name="expire" value="" required>
                        </div>
                        <Strong>Upload hier een foto van de overledene</Strong>
                        <label class="custom-file-upload-deceased">
                            <input name="img" type="file" style="display:none" accept="image/*" onchange="displaySelectedImages(this)"/>
                            <img id="img" src="{{asset('img/add-image.png')}}" alt="">
                            <div id="image-preview-container"></div>
                        </label>
                        <input type="hidden" name="questionnaire_id" value="{{$questionnaire->id}}">
                        <div class="deceased-btn">
                            <button type="submit">Volgende</button>
                        </div>

                        
                    </form>
                @else
                    <form class="formproject" action="{{ route('deceased.update',$deceased->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-input-questionnaire">
                            <strong>Naam</strong>
                            <input type="text" name="name" placeholder="Naam" value="{{$deceased->name}}">
                            @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Stad</strong>
                            <input type="text" name="city" placeholder="Stad" value="{{$deceased->city}}">
                            @error('city')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Postcode</strong>
                            <input type="text" name="zipcode" placeholder="Postcode" value="{{$deceased->zipcode}}">
                            @error('adress')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Adres</strong>
                            <input type="text" name="adress" placeholder="Straat naam + Huisnummer" value="{{$deceased->adress}}">
                            @error('adress')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Geboortedatum</strong>
                            <input type="date" name="date_of_birth" value="{{$deceased->date_of_birth}}">
                            @error('date_of_birth')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror           
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Overlijdensdatum</strong>
                            <input type="date" name="date_of_death" value="{{$deceased->date_of_death}}">
                            @error('date_of_death')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <label for="expire">Afsluitdatum</label>
                            <input type="datetime-local" name="expire" value="{{$questionnaire->expire}}" required>
                        </div>
                        @if(isset($deceased->img))
                            <div class="form-input-questionnaire">
                                <img style=" width: 200px;" src="{{asset('storage/' . $deceased->img)}}" alt="{{$deceased->img}}">
                                <input type="hidden" name="img" value="{{$deceased->img}}">
                                <a href="{{ route('deceased.destroyImg', $deceased->id) }}">Verwijder foto</a>         
                            </div>
                        @else
                            <Strong>Upload hier een foto van de overledene</Strong>
                            <label class="custom-file-upload-deceased">
                                <input name="img" type="file" style="display:none" accept="image/*" onchange="displaySelectedImages(this)"/>
                                <img id="img" src="{{asset('img/add-image.png')}}" alt="">
                                <div id="image-preview-container"></div>
                            </label>
                        @endif
                        <input type="hidden" name="questionnaire_id" value="{{$questionnaire->id}}">
                        <div class="deceased-btn">
                            <button type="submit">Volgende</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <script>
        function displaySelectedImages(input) {
            var previewContainer = document.getElementById('image-preview-container');
            let previewImageEl = document.getElementById('img');
    
            if (input.files && input.files.length > 0) {
                previewContainer.innerHTML = ''; // Clear previous previews
                for (var i = 0; i < input.files.length; i++) {
                    var reader = new FileReader();
    
                    reader.onload = function (e) {
                        var imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.alt = 'Selected Image';
                        previewImageEl.style.display = 'none';
                        previewContainer.style.display = 'block';
                        previewContainer.appendChild(imgElement);
                    };
    
                    reader.readAsDataURL(input.files[i]);
                }
            }

            if(input.files.length == 0){
                previewImageEl.style.display = 'block';
                previewContainer.style.display = 'none';
                console.log('test');
            }
        }
    </script>
</x-app-layout>