<x-layout>
    <h1>Welkom naar de Teams pagina!</h1>
    <ul>
        @foreach($teams as $team)
            <li>
                {{ $team->name }}
                Het Team van: {{ $team->user_id }}
            </li>
        @endforeach
    </ul>
</x-layout>
