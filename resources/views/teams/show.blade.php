<x-layout><br>
    <h1>Alle spelers van Team: {{ $team->name }}</h1>

    @if(Auth::id() === $team->user_id || Auth::user()->is_admin == 1)
    <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-primary">Bewerk Team</a>
    @endif

    <h2>Actieve Spelers</h2>
    <ul>
        @php
            $positionOrder = ['Keeper', 'Verdediger', 'Middenvelder', 'Aanvaller'];

            $sortedPlayers = $team->players->sortBy(function ($player) use ($positionOrder) {
                return array_search($player->position, $positionOrder);
            });
        @endphp

        @forelse($sortedPlayers as $player)
            <li>{{ $player->position }} | {{ $player->club }} | {{ $player->name }}</li>
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
            <li>{{ $player->position }} | {{ $player->club }} | {{ $player->name }} | Gewisseld</li>
        @empty
            <li>Geen gewisselde spelers in dit team</li>
        @endforelse
    </ul>

    @if(Auth::id() === $team->user_id || Auth::user()->is_admin == 1)
    <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je dit team wilt verwijderen?');">Verwijder Team</button>
    </form>
    @endif

    <a href="{{url(route('teams.index'))}}">Terug naar de Teams pagina</a>

</x-layout>
