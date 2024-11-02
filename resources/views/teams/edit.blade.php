<x-layout><br>
    <h1>Bewerk Team: {{ $team->name }}</h1>  <!-- Display the team's name for editing -->

    <form action="{{ route('teams.update', $team->id) }}" method="POST">  <!-- Form to update the team -->
        @csrf  <!-- CSRF token for form security -->
        @method('PUT')  <!-- Specify that this is a PUT request for updating -->

        <h2>Actieve Spelers</h2>  <!-- Section title for active players -->
        <ul>
            @foreach($team->players as $player)  <!-- Loop through each player in the team -->
            <li>
                {{ $player->position }} | {{ $player->club }} | {{ $player->name }}  <!-- Display player's position, club, and name -->
                <select name="substitutions[{{ $player->id }}]">  <!-- Dropdown to select a substitute for the player -->
                    <option value="">Selecteer vervanger</option>  <!-- Default option for the dropdown -->
                    @foreach($availablePlayers[$player->position] as $substitute)  <!-- Loop through available substitutes for the player’s position -->
                    @if($substitute->eligibility == 0)  <!-- Check if the substitute is eligible -->
                    <option value="{{ $substitute->id }}">{{ $substitute->name }}</option>  <!-- Display substitute's name -->
                    @endif
                    @endforeach
                </select>
            </li>
            @endforeach
        </ul>

        <button type="submit" class="btn btn-success">Opslaan</button>  <!-- Submit button to save changes -->
    </form>
</x-layout>
