<x-layout><br>
    <h1>Welkom naar de Spelers pagina!</h1>

    <form method="GET" action="{{ route('players.index') }}">
        <div>
            <label for="player_search">Zoek een speler:</label>
            <input type="text" name="player_search" id="player_search" value="{{ old('player_search', $playerSearchTerm) }}">
        </div>

        <button type="submit">Search</button>
    </form><br>

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
