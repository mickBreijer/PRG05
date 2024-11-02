<x-layout><br>

    <h1>{{$player->name}}</h1>

    @if(Auth::check() && Auth::user()->is_admin == 1)
    <a href="{{ route('players.edit', $player->id) }}" class="btn btn-primary">Bewerk Speler</a>
    @endif

    <p>Club: {{ $player->club }}</p>
    <p>Positie: {{ $player->position }}</p>
    <p>Waarde: {{ $player->value }}</p>

    @if(Auth::check() && Auth::user()->is_admin == 1)
    <form action="{{ route('players.destroy', $player->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je deze speler wilt verwijderen?');">Verwijder Speler</button>
    </form>
    @endif

    <a href="{{url(route('players.index'))}}">Terug naar de Spelers pagina</a>

</x-layout>
