<x-app-layout>
    <form class="formproject" action="{{ route('companies.update',$company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <h1>{{$company->name}}</h1>
    @if(count($company->users) > 0)
        <p>Actief gekoppelde accounts:</p>

        @foreach($company->users as $user)
            <input type="checkbox" id="" name="deleteUsers[]" value="{{$user->id}}">
            <label for="">{{$user->name}}</label>
        @endforeach
    @endif

    <label for="users">Select an option:</label>
    <select name="users[]" multiple>
        @foreach($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>



    </form>
        

</x-app-layout>
