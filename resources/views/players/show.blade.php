<x-layout><br>

    <h1>{{$player->name}}</h1>  <!-- Display the player's name -->

    @if(Auth::check() && Auth::user()->is_admin == 1)  <!-- Check if the user is authenticated and is an admin -->
    <a href="{{ route('players.edit', $player->id) }}" class="btn btn-primary">Bewerk Speler</a>  <!-- Link to edit the player -->
    @endif

    <p>Club: {{ $player->club }}</p>  <!-- Display the player's club -->
    <p>Positie: {{ $player->position }}</p>  <!-- Display the player's position -->
    <p>Waarde: {{ $player->value }}</p>  <!-- Display the player's value -->

    @if(Auth::check() && Auth::user()->is_admin == 1)  <!-- Check if the user is authenticated and is an admin -->
    <form action="{{ route('players.destroy', $player->id) }}" method="POST" style="display:inline;">  <!-- Form for deleting the player -->
        @csrf
        @method('DELETE')  <!-- Use DELETE method for form submission -->
        <button type="submit" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je deze speler wilt verwijderen?');">Verwijder Speler</button>  <!-- Button to confirm deletion -->
    </form>
    @endif

    <a href="{{url(route('players.index'))}}">Terug naar de Spelers pagina</a>  <!-- Link to go back to the players page -->

</x-layout>
