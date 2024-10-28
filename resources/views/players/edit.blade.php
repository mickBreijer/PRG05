<x-layout>
    <h1>Bewerk Speler: {{ $player->name }}</h1>

    <form action="{{ route('players.update', $player->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Naam</label>
            <input type="text" id="name" name="name" value="{{ old('name', $player->name) }}" required>
        </div>

        <div>
            <label for="club">Club</label>
            <input type="text" id="club" name="club" value="{{ old('club', $player->club) }}" required>
        </div>

        <div>
            <label for="value">Waarde</label>
            <input type="number" id="value" name="value" value="{{ old('value', $player->value) }}" required>
        </div>

        <div>
            <label for="position">Positie</label>
            <input type="text" id="position" name="position" value="{{ old('position', $player->position) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Bijwerken</button>
    </form>

    <a href="{{ route('players.index') }}" class="btn btn-secondary">Terug naar Spelerslijst</a>
</x-layout>
