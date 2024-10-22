<x-layout>
    <h1>Welkom naar de Teams pagina!</h1>
    <form action="{{ route('teams.create') }}" method="POST">
        @csrf
        <button type="submit">Maak je eigen Team</button>
    </form>

    <ul>
        @foreach($teams as $team)
            <li>
                {{ $team->name }}
                Het Team van: {{ $team->user_id }}
            </li>
        @endforeach
    </ul>
</x-layout>
