<x-app-layout>
    <div class="information-container">
        <div class="information-sub-container">
            <div class="sub">
                <div class="information-section">
                    <div class="succes">
                        <img style="width: 130px;" src="{{ asset('img/check.png')}}" alt="">
                        <h1 style="font-size: 20px; color: green; ">Alles is succesvol ingevuld</h1>
                    </div>
                    <div class="customer-code">
                        <p>Klanten code: </p>
                        <p style="font-size: 20px"><strong>{{$questionnaire->customer_code}}</strong></p>
                    </div>
                    <div class="QR-code">
                        <p>Hier komt de QR-code</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
