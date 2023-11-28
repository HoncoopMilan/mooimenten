<x-app-layout>
    <form action="{{ route('questionnaire.store') }}" method="POST" enctype="multipart/form-data">
        @csrf  
        <input type="text" name="name" id="">
        <button type="submit">Submit</button> 
    </form>
    @if (\Session::has('error'))
        <p style="color: red">{!! \Session::get('error') !!}</p>
    @elseif(\Session::has('succes'))
    <p style="color: green">{!! \Session::get('succes') !!}</p>

    @endif
    <table>
        <tr>
            <th>Naam</th>
            <th>Aantal keer ingevuld</th>
        </tr>
        <tr>
            @foreach ($questionnaires as $questionnaire)
            <td><a href="{{ route('deceased.questionnaire', $questionnaire->name) }}">{{$questionnaire->name}}</a></td>
            <td>{{$questionnaire->completed_times}}</td>
            @endforeach
        </tr>
    </table>
</x-app-layout>