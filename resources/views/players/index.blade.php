<x-layout>
    <h1>Welkom naar de Spelers pagina!</h1>
    <ul>
        @foreach($players as $player)
            <li>
                <a href="{{ route('players.show', ['id' => $player->id]) }}">
                    {{ $player->name }}
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>
