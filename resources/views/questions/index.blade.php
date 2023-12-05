<x-app-layout>
    <h2>Vragen overzicht</h2>
    <p>Om een vraag aan te maken zet waar de naam van de overledenen %name% neer, zodat de naam daar komt.</p>
    <form style="margin: 0px;" action="{{ route('question.storeQuestion') }}" method="POST" enctype="multipart/form-data">
        @csrf  
        <input type="text" name="question" id="">
        <button type="submit">Submit</button> 
    </form> 

    <div class="form-group" style="margin-top: 20px;">
        @foreach($questions as $question)
            <form style="margin-top: 3px; margin-bottom: 3px;" action="{{ route('question.update',$question->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')     
                <input style="width: 300px;" type="text" name="question" id="" value="{{$question->question}}">
                <button type="submit">Aanpassen</button> 
            </form>   
        @endforeach
    </div>
</x-app-layout>