<x-layout><br>

{{--    <a href="{{ route('players.edit', $player->id) }}" class="btn btn-primary">Bewerk Speler</a>--}}

    <h1>{{$player->name}}</h1>
    <p>Club: {{ $player->club }}</p>
    <p>Positie: {{ $player->position }}</p>
    <p>Waarde: {{ $player->value }}</p>

    <form action="{{ route('players.destroy', $player->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je deze speler wilt verwijderen?');">Verwijder Speler</button>
</x-layout>
