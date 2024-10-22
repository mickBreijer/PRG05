<x-layout><br>
    <form action="{{ route('teams.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Maak je Team</label>
            <input type="text" id="name" name="name" required>
        </div><br>

        <div>
            <label>Selecteer 11 Spelers</label><br>
            @for ($i = 1; $i <= 11; $i++)
                <label for="player_{{ $i }}">Speler {{ $i }}</label>
                <select name="players[]" id="player_{{ $i }}" required>
                    <option value="">Kies een speler</option> <!-- Placeholder option -->
                    @foreach($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select><br>
            @endfor
        </div><br>

        <button type="submit">Publiceer</button>
    </form>
</x-layout>
