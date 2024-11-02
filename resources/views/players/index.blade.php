<x-layout><br>
    <h1>Welkom naar de Spelers pagina!</h1>  <!-- Welcome message for the players page -->

    <form method="GET" action="{{ route('players.index') }}">  <!-- Search form for players -->
        <div>
            <label for="player_search">Zoek een Speler:</label>
            <input type="text" name="player_search" id="player_search" value="{{ old('player_search', $playerSearchTerm) }}">  <!-- Input for searching a player -->
        </div>

        <div>
            <label for="position">Positie:</label>
            <select name="position" id="position">  <!-- Dropdown for selecting player position -->
                <option value="">Alles</option>  <!-- Option to show all players -->
                <option value="Aanvaller" {{ old('position', $position) == 'Aanvaller' ? 'selected' : '' }}>Aanvaller</option>  <!-- Forward -->
                <option value="Middenvelder" {{ old('position', $position) == 'Middenvelder' ? 'selected' : '' }}>Middenvelder</option>  <!-- Midfielder -->
                <option value="Defender" {{ old('position', $position) == 'Defender' ? 'selected' : '' }}>Verdediger</option>  <!-- Defender -->
                <option value="Keeper" {{ old('position', $position) == 'Keeper' ? 'selected' : '' }}>Doelman</option>  <!-- Goalkeeper -->
            </select>
        </div>

        <button type="submit">Search</button>  <!-- Button to submit the search -->
    </form><br>

    <ul>
        @foreach($players as $player)  <!-- Loop through each player -->
        <li>
            <a href="{{ url(route('players.show', $player->id)) }}" onclick="playerViewed()">
                {{ $player->name }}  <!-- Player name as a clickable link -->
            </a>
        </li>
        @endforeach
    </ul>

    <script>
        // Function to track player views
        function playerViewed() {
            // Check if the user has already created a team
            if (localStorage.getItem('teamCreated') === 'true') {
                return; // If they have created a team, do nothing
            }

            // Get the current count from local storage
            let viewedCount = localStorage.getItem('viewedPlayersCount') || 0;
            viewedCount = parseInt(viewedCount) + 1; // Increment the count
            localStorage.setItem('viewedPlayersCount', viewedCount); // Store it back

            // Optional: Notify the user when they reach 3 views
            if (viewedCount === 3) {
                alert('Je hebt 3 spelers bekeken! Je kunt nu een team aanmaken.');  // Alert to notify user
            }
        }
    </script>
</x-layout>
