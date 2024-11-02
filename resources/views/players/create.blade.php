<x-layout><br>
    <form action="{{ route('players.store') }}" method="POST">  <!-- Form to create a new player -->
        @csrf
        <div>
            <label for="name">Speler Naam</label>
            <input type="text" id="name" name="name" required>  <!-- Input for player name -->
        </div><br>
        <div>
            <label for="club">Club</label>
            <select name="club" id="club" required>  <!-- Dropdown for selecting club -->
                <option value="">Kies een club</option>
                <option value="Feyenoord">Feyenoord</option>
                <option value="Almere City FC">Almere City FC</option>
                <option value="AZ">AZ</option>
                <option value="FC Groningen">FC Groningen</option>
                <option value="FC Twente">FC Twente</option>
                <option value="FC Utrecht">FC Utrecht</option>
                <option value="Fortuna Sittard">Fortuna Sittard</option>
                <option value="Go Ahead Eagles">Go Ahead Eagles</option>
                <option value="Heracles Almelo">Heracles Almelo</option>
                <option value="NAC Breda">NAC Breda</option>
                <option value="N.E.C. Nijmegen">N.E.C. Nijmegen</option>
                <option value="PEC Zwolle">PEC Zwolle</option>
                <option value="PSV">PSV</option>
                <option value="RKC Waalwijk">RKC Waalwijk</option>
                <option value="SC Heerenveen">SC Heerenveen</option>
                <option value="Sparta Rotterdam">Sparta Rotterdam</option>
                <option value="Willem II">Willem II</option>
                <option value="Ajax">Ajax</option>
            </select>
        </div><br>
        <div>
            <label for="value">Speler Waarde</label>
            <input type="number" id="value" name="value" min="0" required>  <!-- Input for player value -->
        </div><br>
        <div>
            <label for="position">Positie</label>
            <select name="position" id="position" required>  <!-- Dropdown for selecting position -->
                <option value="">Kies een positie</option>
                <option value="Keeper">Keeper</option>
                <option value="Verdediger">Verdediger</option>
                <option value="Middenvelder">Middenvelder</option>
                <option value="Aanvaller">Aanvaller</option>
            </select>
        </div><br>
        <button type="submit">Maak Speler</button>  <!-- Submit button to create player -->
    </form>
</x-layout>
