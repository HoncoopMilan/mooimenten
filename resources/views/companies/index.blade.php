<x-app-layout>
    <form class="companyCreateForm" action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf  
        <input style="display: none" type="text" name="name" id="">
    </form>
    <button class="companyCreate" style="margin-bottom: 15px;">Bedrijf aanmaken</button>
    @if (\Session::has('error'))
    <p style="color: red">{!! \Session::get('error') !!}</p>
    @elseif(\Session::has('succes'))
    <p style="color: green">{!! \Session::get('succes') !!}</p>
    @endif


    @foreach($companies as $company)
    <div class="companies" style="margin-bottom: 10px;">
        <p>{{$company->name}}</p>
        @if(count($company->users) > 0)
            <p>Gekoppelde gebruikers: {{ count($company->users) }}</p>
        @else
        @endif
    </div>
    @endforeach

    <script>
        const questionnaireCreate = document.querySelector('.companyCreate');
        const questionnaireForm = document.querySelector('.companyCreateForm');

        questionnaireCreate.addEventListener('click', () => {
            let questionnaireName = prompt('Naam van de vragenlijst');
            let nameInput = questionnaireForm.querySelector('input[name="name"]');
            nameInput.value = questionnaireName;

            if(questionnaireName != null){
                questionnaireForm.submit();
            }
        });
    </script>
</x-app-layout>
