<x-layout><br>
    <form action="{{ route('teams.store') }}" method="POST" id="team-form">
        @csrf
        <div>
            <label for="name">Maak je Team</label>  <!-- Label for the team name input -->
            <input type="text" id="name" name="name" required>  <!-- Input field for team name -->
        </div><br>

        <div>
            <label>Selecteer je Spelers</label><br>

            @if ($errors->any())  <!-- Check if there are any validation errors -->
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)  <!-- Loop through all error messages -->
                    <li>{{ $error }}</li>  <!-- Display each error message -->
                    @endforeach
                </ul>
            </div>
            @endif

            <h4>Keeper</h4>
            <select name="players[keeper]" required onchange="updateOptions(this)">  <!-- Dropdown for selecting a keeper -->
                <option value="">Kies een keeper</option>
                @foreach($players as $player)  <!-- Loop through players to populate dropdown -->
                @if($player->eligibility == 0 && $player->position == 'Keeper')  <!-- Check if player is eligible and is a keeper -->
                <option value="{{ $player->id }}">{{ $player->name }}</option>  <!-- Display keeper's name -->
                @endif
                @endforeach
            </select><br>

            <h4>Verdedigers</h4>
            @for ($i = 1; $i <= 4; $i++)  <!-- Loop to create dropdowns for defenders -->
            <select name="players[verdediger][]" required onchange="updateOptions(this)">
                <option value="">Kies een verdediger</option>
                @foreach($players as $player)
                    @if($player->eligibility == 0 && $player->position == 'Verdediger')  <!-- Check eligibility and position -->
                    <option value="{{ $player->id }}">{{ $player->name }}</option>  <!-- Display defender's name -->
                    @endif
                @endforeach
            </select><br>
            @endfor

            <h4>Middenvelders</h4>
            @for ($i = 1; $i <= 3; $i++)  <!-- Loop to create dropdowns for midfielders -->
            <select name="players[middenvelder][]" required onchange="updateOptions(this)">
                <option value="">Kies een middenvelder</option>
                @foreach($players as $player)
                    @if($player->eligibility == 0 && $player->position == 'Middenvelder')  <!-- Check eligibility and position -->
                    <option value="{{ $player->id }}">{{ $player->name }}</option>  <!-- Display midfielder's name -->
                    @endif
                @endforeach
            </select><br>
            @endfor

            <h4>Aanvallers</h4>
            @for ($i = 1; $i <= 3; $i++)  <!-- Loop to create dropdowns for attackers -->
            <select name="players[aanvaller][]" required onchange="updateOptions(this)">
                <option value="">Kies een aanvaller</option>
                @foreach($players as $player)
                    @if($player->eligibility == 0 && $player->position == 'Aanvaller')  <!-- Check eligibility and position -->
                    <option value="{{ $player->id }}">{{ $player->name }}</option>  <!-- Display attacker's name -->
                    @endif
                @endforeach
            </select><br>
            @endfor
        </div><br>

        <button type="submit">Publiceer</button>  <!-- Submit button to create the team -->
    </form>

    <script>
        function updateOptions(selectElement) {  // Function to update options based on selected players
            const selectedValues = Array.from(document.querySelectorAll('select'))
                .map(select => select.value)  // Get currently selected values
                .filter(value => value);  // Filter out empty values

            document.querySelectorAll('select').forEach(select => {
                const options = select.querySelectorAll('option');  // Get all options for each select
                options.forEach(option => {
                    if (selectedValues.includes(option.value) && option.value !== select.value) {
                        option.disabled = true;  // Disable already selected players in other selects
                    } else {
                        option.disabled = false;  // Enable options that are not selected
                    }
                });
            });
        }
    </script>
</x-layout>
