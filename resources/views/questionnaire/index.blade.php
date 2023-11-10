<x-app-layout>
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