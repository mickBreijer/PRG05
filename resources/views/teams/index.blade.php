<x-layout>
    <div class="container">
        <h1>Teams</h1>  <!-- Title for the Teams section -->

        <form method="GET" action="{{ route('teams.index') }}">  <!-- Search form for players in teams -->
            <div>
                <label for="player_search">Zoek een Speler in een Team:</label>  <!-- Label for the search input -->
                <input type="text" name="player_search" id="player_search" value="{{ old('player_search', $playerSearchTerm) }}">  <!-- Input field for player search -->
            </div>

            <button type="submit">Search</button>  <!-- Submit button for the search form -->
        </form><br>

        @if (session('error'))  <!-- Check if there's an error message in the session -->
        <div style="color: red;">
            {{ session('error') }}  <!-- Display the error message -->
        </div>
        @endif

        <a href="{{ route('teams.create') }}" id="create-team-link">Maak je eigen Team</a>  <!-- Link to create a new team -->

        <h2>Teams</h2>  <!-- Subtitle for the list of teams -->
        @if($teams->isEmpty())  <!-- Check if the teams collection is empty -->
        <p>Geen Teams gevonden</p>  <!-- Message displayed if no teams are found -->
        @else
            <ul>
                @foreach($teams as $team)  <!-- Loop through each team -->
                @if($team->is_active == 1)  <!-- Check if the team is active -->
                <li>
                    <a href="{{ route('teams.show', $team->id) }}">  <!-- Link to view the team details -->
                        {{ $team->name }} Het Team van: {{$team->user->name}}  <!-- Display the team name and the user's name -->
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
        @endif
    </div>

    <script>
        document.getElementById('create-team-link').addEventListener('click', function(event) {
            // Get the viewed players count from local storage
            let viewedCount = localStorage.getItem('viewedPlayersCount') || 0;

            // Check if the count is less than 3
            if (parseInt(viewedCount) < 3) {
                event.preventDefault(); // Prevent the default action
                alert('Je moet minstens 3 spelers bekijken voordat je een team kunt aanmaken.'); // Alert the user
                window.location.href = "{{ route('players.index') }}"; // Redirect to players index
            }
        });
    </script>
</x-layout>
