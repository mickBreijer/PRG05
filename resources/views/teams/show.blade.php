<x-layout><br>
    <h1>Alle spelers van Team: {{ $team->name }}</h1>

    <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-primary">Bewerk Team</a>

    <h2>Actieve Spelers</h2>
    <ul>
        @forelse($team->players as $player)
            <li>{{ $player->name }} | {{ $player->position }}</li>
        @empty
            <li>Geen actieve spelers in dit team</li>
        @endforelse
    </ul>

    <h2>Gewisselde Spelers</h2>
    <ul>
        @forelse($team->substitutedPlayers as $player)
            <li>{{ $player->name }} | {{ $player->position }} | Gewisseld</li>
        @empty
            <li>Geen gewisselde spelers in dit team</li>
        @endforelse
    </ul>
</x-layout>
