<x-layout>
    <div class="container">
        <h1>Teams</h1>

        <form method="GET" action="{{ route('teams.index') }}">
            <div>
                <label for="player_search">Zoek een Speler in een Team:</label>
                <input type="text" name="player_search" id="player_search" value="{{ old('player_search', $playerSearchTerm) }}">
            </div>

            <button type="submit">Search</button>
        </form><br>

        @if (session('error'))
            <div style="color: red;">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('teams.create') }}" id="create-team-link">Maak je eigen Team</a>

        <h2>Teams</h2>
        @if($teams->isEmpty())
            <p>Geen Teams gevonden</p>
        @else
            <ul>
                @foreach($teams as $team)
                    @if($team->is_active == 1)
                        <li>
                            <a href="{{ route('teams.show', $team->id) }}">
                                {{ $team->name }} Het Team van: {{$team->user->name}}
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
                alert('Je moet minstens 3 spelers bekijken voordat je een team kunt aanmaken.');
                window.location.href = "{{ route('players.index') }}"; // Redirect to players index
            }
        });
    </script>
</x-layout>
