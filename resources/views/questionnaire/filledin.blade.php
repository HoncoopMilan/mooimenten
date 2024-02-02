<x-app-layout>
    <div class="information-container">
        <div class="information-sub-container">
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
                            <form action="{{ route('mail', $questionnaire->id) }}" method="POST">
                                @csrf
                                <div class="email-form">
                                    <label for="email">Verzenden naar</label>
                                    <input style="width: 280px;" type="email" name="email" placeholder="Vul hier het emailadres van de klant in" required>
                                </div>
                                <input type="hidden" name="customerCode" value="{{ $questionnaire->customer_code }}">
                                <button style="background-color: #6C7C79" class="email-send-btn" type="submit">Verzenden</button>
                            </form>
                        </div>
                        <div class="QR-code">
                            <a download="qrcode_{{$questionnaire->name}}" href="data:image/png;base64, {{$qrcode}}">
                                <img style="width: 200px" src="data:image/png;base64, {{$qrcode}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
