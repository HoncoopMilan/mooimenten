<x-app-layout>
    <div class="container">
        <div class="sub-container">
            <div class="overledene">
                <img style="width: 150px; height: 150px; object-fit: cover; border-top-left-radius: 5px; border-bottom-left-radius: 5px;" src="{{asset('img/overledene.jpg')}}" alt="">
                <div class="overledene-txt">
                    <h1 style="font-size: 20px;">Pieter Jansen</h1>
                    <div class="geboorte">
                        <img style="width: 15px; height: 15px;" src="{{asset('img/star.png')}}" alt="">
                        <p style="font-size: 14px; margin-left: 4px;">22-11-1960</p>
                    </div>
                    <div class="sterf-datum">
                        <img style="width: 15px; height: 15px;" src="{{asset('img/cross.png')}}" alt="">
                        <p style="font-size: 14px; margin-left: 4px;">14-11-2023</p>
                    </div>
                    <div class="adres">
                        <p>Dorpsstraat 12</p>
                        <p>5511SB Dordrecht</p>
                    </div>
                </div>
            </div>
            {{-- <h2 style="font-size: 20px">Laat al uw herinneringen achter</h2> --}}
            <form action="">
                @csrf
                <div class="form-container">
                    <div class="form-group">
                        <label class="custom-label" >Wat was een grappig moment met Pieter?</label>
                       <textarea  name="" id="custom-textarea"></textarea>
                    </div>
                    <div class="form-image">
                        <div class="label">
                            <label for="">Voeg foto's in</label>
                            <label for="">0/3</label>
                        </div>
                        <label class="custom-file-upload">
                            <input type="file"/>
                            <img src="{{asset('img/add-image.png')}}" alt="">
                        </label>
                    </div>
                    <button type="submit" class="submit-btn">Verstuur uw herinneringen</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>