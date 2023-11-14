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
            <input type="datetime-local" name="date_of_birth" placeholder="Straat naam + Huisnummer">
            @error('date_of_birth')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror           
        </div>
        <div class="form-input-questionnaire">
            <strong>Overlijdensdatum:</strong>
            <input type="datetime-local" name="date_of_death" placeholder="Straat naam + Huisnummer">
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
    
    @endif
</x-app-layout>