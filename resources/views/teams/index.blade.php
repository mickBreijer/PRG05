<x-layout><br>
    <h1>Welkom naar de Teams pagina!</h1>
    <a href="{{url(route('teams.create'))}}">Maak een eigen team</a>

    <ul>
        @foreach($teams as $team)
            <li>
                <a href="{{ url(route('teams.show', $team->id)) }}">
                    {{ $team->name }} Het Team van: {{ $team->user->name }}
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>
