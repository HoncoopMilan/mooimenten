<x-app-layout>
    <div class="answers-grid">
        <div class="anwsers">
            @if($questionnaires != false)
                <div class="questionnaires" style="display: flex; flex-direction: column">
                    @foreach($questionnaires as $questionnaire)
                        <a href="{{route('answer.show', $questionnaire->customer_code)}}">{{$questionnaire->name}}</a>
                    @endforeach
                </div>
            @else
        </div>
        <form action="{{ route('answer.check') }}" method="POST" enctype="multipart/form-data">
            @csrf  
            <p>Klanten code</p>
            <input type="text" name="customercode" id="">
            <button type="submit">Invoeren</button> 
        </form>
        @if (\Session::has('error'))
            <p style="color: red">{!! \Session::get('error') !!}</p>
        @endif
    @endif
    </div>
    
        
</x-app-layout>
