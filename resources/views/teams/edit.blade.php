<x-layout><br>
    <h1>Bewerk Team: {{ $team->name }}</h1>

    <form action="{{ route('teams.update', $team->id) }}" method="POST">
        @csrf
        @method('PUT')

        <h2>Actieve Spelers</h2>
        <ul>
            @foreach($team->players as $player)
                <li>
                    {{ $player->name }} | {{ $player->position }}
                    <select name="substitutions[{{ $player->id }}]">
                        <option value="">Selecteer vervanger</option>
                        @foreach($availablePlayers[$player->position] as $substitute)
                            <option value="{{ $substitute->id }}">{{ $substitute->name }}</option>
                        @endforeach
                    </select>
                </li>
            @endforeach
        </ul>

        <button type="submit" class="btn btn-success">Opslaan</button>
    </form>
</x-layout>
