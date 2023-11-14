<x-app-layout>
    <form action="{{ route('questionnaire.store') }}" method="POST" enctype="multipart/form-data">
        @csrf  
        <input type="text" name="name" id="">
        <button type="submit">Submit</button> 
    </form>
    <table>
        <tr>
            <th>Naam</th>
            <th>Aantal keer ingevuld</th>
        </tr>
        <tr>
            @foreach ($questionnaires as $questionnaire)
            <td>{{$questionnaire->name}}</td>
            <td>{{$questionnaire->completed_times}}</td>
            @endforeach
        </tr>
    </table>
</x-app-layout>