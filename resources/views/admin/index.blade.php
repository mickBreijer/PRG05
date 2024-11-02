<x-layout>
    <h1>Admin</h1>
    <h2>Spelers</h2>
    <a href="{{ url(route('players.create')) }}">Voeg een nieuwe speler toe</a>
    <h2>Teams</h2>

    <ul>
        @foreach($teams as $team)
            <li>
                <a href="{{ route('teams.show', $team->id) }}">
                    {{ $team->name }} Het Team van: {{$team->user->name}}  <!-- Link to the team's details -->
                </a>

                <form action="{{ route('teams.toggle', $team->id) }}" method="POST" style="display:inline;">
                    @csrf  <!-- CSRF protection -->
                    <button type="submit" class="btn btn-warning">
                        {{ $team->is_active ? 'Active' : 'Inactive' }}  <!-- Toggle button for team status -->
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>
