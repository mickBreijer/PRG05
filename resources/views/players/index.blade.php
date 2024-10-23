<x-layout><br>
    <h1>Welkom naar de Spelers pagina!</h1>
    <a href="{{url(route('players.create'))}}">Voeg een nieuwe speler toe</a>

    <ul>
        @foreach($players as $player)
            <li>
                <a href="{{ url(route('players.show', $player->id)) }}">
                    {{ $player->name }}
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>
