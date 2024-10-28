<x-layout><br>
    <h1>Alle spelers van Team: {{ $team->name }}</h1>

    <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-primary">Bewerk Team</a>

    <h2>Actieve Spelers</h2>
    <ul>
        @php
            $positionOrder = ['Keeper', 'Verdediger', 'Middenvelder', 'Aanvaller'];

            $sortedPlayers = $team->players->sortBy(function ($player) use ($positionOrder) {
                return array_search($player->position, $positionOrder);
            });
        @endphp

        @forelse($sortedPlayers as $player)
            <li>{{ $player->name }} | {{ $player->position }}</li>
        @empty
            <li>Geen actieve spelers in dit team</li>
        @endforelse
    </ul>

    <h2>Gewisselde Spelers</h2>
    <ul>
        @php
            $sortedSubstitutedPlayers = $team->substitutedPlayers->sortBy(function ($player) use ($positionOrder) {
                return array_search($player->position, $positionOrder);
            });
        @endphp

        @forelse($sortedSubstitutedPlayers as $player)
            <li>{{ $player->name }} | {{ $player->position }} | Gewisseld</li>
        @empty
            <li>Geen gewisselde spelers in dit team</li>
        @endforelse
    </ul>

    <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je dit team wilt verwijderen?');">Verwijder Team</button>
    </form>

    <a href="{{url(route('teams.index'))}}">Terug naar de Teams pagina</a>

</x-layout>
