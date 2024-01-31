<x-app-layout>
    <div class="company-btn-create">
        <form class="companyCreateForm" action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf  
            <input style="display: none" type="text" name="name" id="">
            <div class="comp-create">
                <button class="companyCreate" style="margin-bottom: 15px;">Bedrijf aanmaken</button>
            </div>

        </form>
        <form action="">
            <input type="search" class="form-control" placeholder="Vind je vragenlijst" name="search" value="{{request('search')}}">
        </form>
    </div>
    
    
    @if (\Session::has('error'))
    <p style="color: red">{!! \Session::get('error') !!}</p>
    @elseif(\Session::has('succes'))
    <p style="color: green">{!! \Session::get('succes') !!}</p>
    @endif

    
    <div class="companies-grid" style="@if(count($companies) > 1) gap: 30px @endif">
        <?php $count = 0; ?>
        @foreach($companies as $company)
        <?php $count++ ?>
        <div class="companies" style="margin-bottom: 10px;">
        <a class="company-name" href="{{route('companie.edit', $company->name)}}">{{$company->name}}</a>
        @if(count($company->users) > 0)
            <p>Gekoppelde gebruikers: {{ count($company->users) }}</p>
        @else
            <p>Er zijn geen gekoppelde gebruikers</p>
        @endif
        <div class="company-btn">
            <form class="delete-{{$count}}" style="margin-top: 3px; margin-bottom: 3px;" action="{{ route('companies.destroy', $company->id) }}" method="Post">
                @csrf
                @method('DELETE')
            </form>
            <button class="submit-{{$count}}" style="margin-left: 5px;">Verwijder bedrijf</button>
        </div>
        
    </div>
    @endforeach
    <p id="count" style="display: none">{{$count}}</p>
    </div>
    

    <script>
        const questionnaireCreate = document.querySelector('.companyCreate');
        const questionnaireForm = document.querySelector('.companyCreateForm');
        const count = document.querySelector('#count');

        questionnaireCreate.addEventListener('click', () => {
            let questionnaireName = prompt('Naam van het bedrijf');
            let nameInput = questionnaireForm.querySelector('input[name="name"]');
            nameInput.value = questionnaireName;

            if(questionnaireName != null){
                questionnaireForm.submit();
            }
        });

        for (let i = 1; i < (Number(count.textContent) + 1); i++) {
            let submit = document.querySelector(`.submit-${i}`);
            let deleteCompany = document.querySelector(`.delete-${i}`);

            submit.addEventListener('click', () => {
                let sure = confirm('Weet u zeker dat u dit bedrijf wilt verwijderen?');
                if(sure == true){
                    deleteCompany.submit();
                }
            });
        }
    </script>
</x-app-layout>
