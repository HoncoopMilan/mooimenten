<x-app-layout>
    <div class="answers">
            @if($questionnaires != false)
            <div class="answers-sub-container">
                <div class="questionnaire-search" style="justify-content: center;">
                    <input style="width: 400px;" type="text" id="searchInput" class="search-bar" placeholder="Zoeken...">
                    <button class="search-btn" onclick="search()"></button>
                </div>

                <div class="questonnaire-container">
                        @foreach($questionnaires as $questionnaire)
                    
                            <a href="{{route('answer.show', $questionnaire->customer_code)}}">
                                <div class="questionnaire" style="padding-top: 10px; padding-bottom: 10px;">
                                    <p style="text-align: center;"><strong>{{$questionnaire->name}}</strong></p>
                                    <div class="document" style="justify-content: center; margin-bottom: 0px !important">
                                        <img style="margin-right: 5px" src="{{ asset('img/document.png')}}" alt="">
                                        <p><strong>{{$questionnaire->completed_times}}x</strong> ingevuld</p>
                                    </div>
                                </div>
                            </a>

                        @endforeach
                </div>
            </div>
            @else
        <div class="information-section" style="width: 300px;">
            <form action="{{ route('answer.check') }}" method="POST" enctype="multipart/form-data">
                @csrf  
                <strong style="font-size: 20px;">Klanten code</strong>
                <div class="input-client-code">
                    <input type="text" name="customercode" id="">
                    <button style="background-color: #6C7C79" class="client-code-btn" type="submit">Invoeren</button> 
                </div>
            </form>
        </div>
        @if (\Session::has('error'))
            <p style="color: red">{!! \Session::get('error') !!}</p>
        @endif
    @endif
    </div>
    
        
</x-app-layout>
