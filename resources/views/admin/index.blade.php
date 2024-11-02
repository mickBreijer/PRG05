<x-layout>
    <h1>Admin</h1>
    <h2>Spelers</h2>
    <a href="{{ url(route('players.create')) }}">Voeg een nieuwe speler toe</a>
    <h2>Teams</h2>

    <ul>
        @foreach($teams as $team)
            <li>
                <a href="{{ route('teams.show', $team->id) }}">
                    {{ $team->name }} Het Team van: {{$team->user->name}}
                </a>

                <form action="{{ route('teams.toggle', $team->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        {{ $team->is_active ? 'Active' : 'Inactive' }}
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>
