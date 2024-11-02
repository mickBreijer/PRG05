<x-layout>
    <div class="container">
        <h1>Teams</h1>


        <form method="GET" action="{{ route('teams.index') }}">
            <div>
                <label for="player_search">Zoek een speler:</label>
                <input type="text" name="player_search" id="player_search" value="{{ old('player_search', $playerSearchTerm) }}">
            </div>

            <button type="submit">Search</button>
        </form><br>

        <a href="{{url(route('teams.create'))}}">Maak je eigen Team</a>

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
</x-layout>
