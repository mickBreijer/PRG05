<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
@if(Route::has('login'))
<nav>
    <x-nav-link href="/" :active="false">Home</x-nav-link>
    <x-nav-link href="/about" :active="false">Over Ons</x-nav-link>
    <x-nav-link href="/contact" :active="false">Contact</x-nav-link>
    <x-nav-link href="/players" :active="false">Spelers</x-nav-link>

    <x-nav-link href="/teams" :active="false">Teams</x-nav-link>
    <x-nav-link href="/login" :active="false">Login</x-nav-link>
    <x-nav-link href="/register" :active="false">Registreren</x-nav-link>
    <x-nav-link href="/dashboard" :active="false">Account</x-nav-link>
    @if(Auth::check() && Auth::user()->is_admin == 1)
        <x-nav-link href="/admin" :active="false">Admin</x-nav-link>
    @endif
</nav>

{{ $slot }}
@endif
</body>
</html>
