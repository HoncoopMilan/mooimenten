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

            {{-- <div class="">
                <div class="sub">
                    <div class="information-section">
                        <div class="succes">
                            <img style="width: 130px;" src="{{ asset('img/check.png')}}" alt="">
                            <h1 style="font-size: 20px; color: green; ">Alles is succesvol ingevuld</h1>
                        </div>
                        <div class="customer-qr">
                            <div class="customer-code">
                                <p>Klanten code: </p>
                                <p style="font-size: 20px"><strong>{{$questionnaire->customer_code}}</strong></p>
                                <form action="">
                                    @csrf
                                    <div class="email-form">
                                        <label for="email">Verzenden naar</label>
                                        <input style="width: 280px;" type="email" name="email" placeholder="gebruiker@gmail.com" required>
                                    </div>
                                    
                                    <button style="background-color: #6C7C79" class="email-send-btn" type="submit">Verzenden</button>
                                </form>
                            </div>
                            <div class="QR-code">
                                <img style="width: 200px" src="{{ asset('img/qr-code.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

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
