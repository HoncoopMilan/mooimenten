<x-app-layout>
    <form class="formproject" action="{{ route('companies.update',$company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <h1 style="font-size: 45px; font-weight: bold; margin-bottom: 15px">{{$company->name}}</h1>
    @if(count($company->users) > 0)
        <p>Ontkoppel een gebruiker:</p>

        @foreach($company->users as $user)
            <input type="checkbox" id="" name="delete_users[]" value="{{$user->id}}">
            <label for="">{{$user->name}}</label>
        @endforeach
    @endif
    
    <div class="add-users" style="display: flex; margin-top: 15px;">
        <label for="users">Voeg gebruiker(s) toe:</label>
        <select name="users[]" multiple>
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>

    <input type="hidden" name="company_id" value="{{$company->id}}" id="">
    <button type="submit">Updaten</button>

    </form>
        

</x-app-layout>
