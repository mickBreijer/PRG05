<x-layout><br>
    <h1>Alle spelers van Team: {{ $team->name }}</h1>
    <ul>
        @foreach($team->players as $player)
            <li>{{ $player->name }} | {{ $player->position }}</li>
        @endforeach
    </ul>
</x-layout>
