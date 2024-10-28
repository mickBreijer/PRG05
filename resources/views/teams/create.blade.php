<x-layout><br>
    <form action="{{ route('teams.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Maak je Team</label>
            <input type="text" id="name" name="name" required>
        </div><br>

        <div>
            <label>Selecteer je Spelers</label><br>

            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h4>Keeper</h4>
            <select name="players[keeper]" required>
                <option value="">Kies een keeper</option>
                @foreach($players as $player)
                    @if($player->position == 'Keeper')
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endif
                @endforeach
            </select><br>

            <h4>Verdedigers</h4>
            @for ($i = 1; $i <= 4; $i++)
                <select name="players[verdediger][]" required>
                    <option value="">Kies een verdediger</option>
                    @foreach($players as $player)
                        @if($player->position == 'Verdediger')
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endif
                    @endforeach
                </select><br>
            @endfor

            <h4>Middenvelders</h4>
            @for ($i = 1; $i <= 3; $i++)
                <select name="players[middenvelder][]" required>
                    <option value="">Kies een middenvelder</option>
                    @foreach($players as $player)
                        @if($player->position == 'Middenvelder')
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endif
                    @endforeach
                </select><br>
            @endfor

            <h4>Aanvallers</h4>
            @for ($i = 1; $i <= 3; $i++)
                <select name="players[aanvaller][]" required>
                    <option value="">Kies een aanvaller</option>
                    @foreach($players as $player)
                        @if($player->position == 'Aanvaller')
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endif
                    @endforeach
                </select><br>
            @endfor
        </div><br>

        <button type="submit">Publiceer</button>
    </form>
</x-layout>
