<x-layout>
    <form action="{{ route('teams.store') }}" method="POST">
        @csrf
        <div>
            <label for="name"> Maak je Team</label>
            <input type="text" id="name" name="name" required>
        </div>
        <button type="submit">Publiceer</button>
    </form>

</x-layout>
