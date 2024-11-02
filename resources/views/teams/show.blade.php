<x-layout><br>
    <h1>Alle spelers van Team: {{ $team->name }}</h1>  <!-- Title displaying the team's name -->

    @if(Auth::id() === $team->user_id || Auth::user()->is_admin == 1)  <!-- Check if the authenticated user is the team owner or an admin -->
    <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-primary">Bewerk Team</a>  <!-- Link to edit the team -->
    @endif

    <h2>Actieve Spelers</h2>  <!-- Subtitle for active players -->
    <ul>
        @php
            // Define the order of positions for sorting
            $positionOrder = ['Keeper', 'Verdediger', 'Middenvelder', 'Aanvaller'];

            // Sort the players based on their position
            $sortedPlayers = $team->players->sortBy(function ($player) use ($positionOrder) {
                return array_search($player->position, $positionOrder);
            });
        @endphp

        @forelse($sortedPlayers as $player)  <!-- Loop through sorted players -->
        <li>{{ $player->position }} | {{ $player->club }} | {{ $player->name }}</li>  <!-- Display player details -->
        @empty  <!-- Fallback if no players are present -->
        <li>Geen actieve spelers in dit team</li>  <!-- Message if no active players -->
        @endforelse
    </ul>

    <h2>Gewisselde Spelers</h2>  <!-- Subtitle for substituted players -->
    <ul>
        @php
            // Sort the substituted players based on their position
            $sortedSubstitutedPlayers = $team->substitutedPlayers->sortBy(function ($player) use ($positionOrder) {
                return array_search($player->position, $positionOrder);
            });
        @endphp

        @forelse($sortedSubstitutedPlayers as $player)  <!-- Loop through sorted substituted players -->
        <li>{{ $player->position }} | {{ $player->club }} | {{ $player->name }} | Gewisseld</li>  <!-- Display substituted player details -->
        @empty  <!-- Fallback if no substituted players are present -->
        <li>Geen gewisselde spelers in dit team</li>  <!-- Message if no substituted players -->
        @endforelse
    </ul>

    @if(Auth::id() === $team->user_id || Auth::user()->is_admin == 1)  <!-- Check if the authenticated user can delete the team -->
    <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display:inline;">  <!-- Form to delete the team -->
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je dit team wilt verwijderen?');">Verwijder Team</button>  <!-- Button to confirm deletion -->
    </form>
    @endif

    <a href="{{ url(route('teams.index')) }}">Terug naar de Teams pagina</a>  <!-- Link to go back to the teams page -->
</x-layout>
