<x-app-layout>
    @if( !isset($deceased))
        <form class="formproject" action="{{ route('deceased.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-input-questionnaire">
                <strong>Naam:</strong>
                <input type="text" name="name" placeholder="Naam">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input-questionnaire">
                <strong>Stad:</strong>
                <input type="text" name="city" placeholder="Stad">
                @error('city')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input-questionnaire">
                <strong>Postcode:</strong>
                <input type="text" name="zipcode" placeholder="Postcode">
                @error('adress')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input-questionnaire">
                <strong>Adres:</strong>
                <input type="text" name="adress" placeholder="Straat naam + Huisnummer">
                @error('adress')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input-questionnaire">
                <strong>Geboortedatum:</strong>
                <input type="date" name="date_of_birth">
                @error('date_of_birth')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror           
            </div>
            <div class="form-input-questionnaire">
                <strong>Overlijdensdatum:</strong>
                <input type="date" name="date_of_death">
                @error('date_of_death')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input-questionnaire">
                <strong>Foto van hem:</strong>
                <input type="file" name="img" multiple="true">
                @error('img')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <input type="hidden" name="questionnaire_id" value="{{$questionnaire->id}}">
            <button type="submit">Volgende</button>
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
                    <a href="{{ route('deceased.destroyImg', $deceased->id) }}">Verwijder foto</a>         
                </div>
                <input type="hidden" name="img" id="">
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
</x-app-layout>