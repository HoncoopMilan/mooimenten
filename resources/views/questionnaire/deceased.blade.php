<x-app-layout>
    <div class="deceased-container">
        <div class="deceased-sub-container">
            <div class="deceased-sub-sub-container">
                <h1 style="font-size: 20px; margin-bottom: 20px; margin-top: 40px;">Vul hieronder de gegevens in van de overledene</h1>
                @if( !isset($deceased))
                    <form class="formproject" action="{{ route('deceased.store') }}" method="POST" enctype="multipart/form-data">
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
                        {{-- <div class="form-input-questionnaire">
                            <strong>Foto van hem:</strong>
                            <input type="file" name="img" multiple="true">
                            @error('img')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <Strong>Upload hier een foto van de overledene</Strong>
                        <label class="custom-file-upload-deceased">
                            <input name="img" type="file" multiple style="display:none" accept="image/*" onchange="checkImageCount(this)"/>
                            <img id="img" src="{{asset('img/add-image.png')}}" alt="">
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
                            <strong>Naam:</strong>
                            <input type="text" name="name" placeholder="Naam" value="{{$deceased->name}}">
                            @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Stad:</strong>
                            <input type="text" name="city" placeholder="Stad" value="{{$deceased->city}}">
                            @error('city')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Postcode:</strong>
                            <input type="text" name="zipcode" placeholder="Postcode" value="{{$deceased->zipcode}}">
                            @error('adress')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Adres:</strong>
                            <input type="text" name="adress" placeholder="Straat naam + Huisnummer" value="{{$deceased->adress}}">
                            @error('adress')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Geboortedatum:</strong>
                            <input type="date" name="date_of_birth" value="{{$deceased->date_of_birth}}">
                            @error('date_of_birth')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror           
                        </div>
                        <div class="form-input-questionnaire">
                            <strong>Overlijdensdatum:</strong>
                            <input type="date" name="date_of_death" value="{{$deceased->date_of_death}}">
                            @error('date_of_death')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        @if(isset($deceased->img))
                            <div class="form-input-questionnaire">
                                <img style=" width: 200px;" src="{{asset('storage/' . $deceased->img)}}" alt="{{$deceased->img}}">
                                <input type="hidden" name="img" value="{{$deceased->img}}">
                                <a href="{{ route('deceased.destroyImg', $deceased->id) }}">Verwijder foto</a>         
                            </div>
                        @else
                            <div class="form-input-questionnaire">
                                <strong>Foto van hem:</strong>
                                <input type="file" name="img" multiple="true">
                                @error('img')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                        <input type="hidden" name="questionnaire_id" value="{{$questionnaire->id}}">
                        <button type="submit">Volgende</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>