<x-app-layout>
    <h2>Vragen overzicht</h2>
    <p>Om een vraag aan te maken zet waar de naam van de overledenen %name% neer, zodat de naam daar komt.</p>
    <form style="margin: 0px;" action="{{ route('question.storeQuestion') }}" method="POST" enctype="multipart/form-data">
        @csrf  
        <input type="text" name="question" id="">
        <button type="submit">Submit</button> 
    </form> 

    <div class="form" style="margin-top: 20px;">
        @foreach($questions as $question)
        <div class="form-group" style="display:flex; align-items: center;">
            <form style="margin-top: 3px; margin-bottom: 3px;" action="{{ route('question.update',$question->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')     
                <input style="width: 300px;" type="text" name="question" id="" value="{{$question->question}}">
                <button type="submit">Aanpassen</button> 
            </form>   
            <form style="margin-top: 3px; margin-bottom: 3px;" action="{{ route('question.destroy', $question->id) }}" method="Post">
                @csrf
                @method('DELETE')
                <button style="margin-left: 5px;" type="submit">Verwijderen</button>
            </form>
        </div>
        @endforeach
    </div>
</x-app-layout>