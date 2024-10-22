<x-layout><br>
    <h1>{{ $team->name }}</h1>
    <ul>
        @forelse($team->players as $player)
            <li>{{$player->name}}</li>
        @empty
        <p>geen spelers in dit team</p>
        @endforelse
    </ul>
</x-layout>
