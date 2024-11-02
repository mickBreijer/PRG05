<x-layout>
    <h1>Bewerk Speler: {{ $player->name }}</h1>  <!-- Displaying the player's name being edited -->

    <form action="{{ route('players.update', $player->id) }}" method="POST">  <!-- Form to update the player -->
        @csrf  <!-- CSRF protection -->
        @method('PUT')  <!-- Specify the method as PUT for updating -->

        <div>
            <label for="name">Naam</label>
            <input type="text" id="name" name="name" value="{{ old('name', $player->name) }}" required>  <!-- Input for player's name -->
        </div>

        <div>
            <label for="club">Club</label>
            <input type="text" id="club" name="club" value="{{ old('club', $player->club) }}" required>  <!-- Input for player's club -->
        </div>

        <div>
            <label for="value">Waarde</label>
            <input type="number" id="value" name="value" value="{{ old('value', $player->value) }}" required>  <!-- Input for player's value -->
        </div>

        <div>
            <label for="position">Positie</label>
            <input type="text" id="position" name="position" value="{{ old('position', $player->position) }}" required>  <!-- Input for player's position -->
        </div>

        <div>
            <label for="eligibility">Speelbaar</label>
            <input type="number" id="eligibility" name="eligibility" value="{{ old('eligibility', $player->eligibility) }}" required>  <!-- Input for player's eligibility -->
        </div>

        <button type="submit" class="btn btn-primary">Bijwerken</button>  <!-- Button to submit the update -->
    </form>

    <a href="{{ route('players.index') }}" class="btn btn-secondary">Terug naar Spelerslijst</a>  <!-- Link to return to player list -->
</x-layout>
