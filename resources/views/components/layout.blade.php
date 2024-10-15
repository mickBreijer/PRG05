<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
<nav>
    <x-nav-link href="/" :active="false">Home</x-nav-link>
    <x-nav-link href="/about" :active="false">About</x-nav-link>
    <x-nav-link href="/contact" :active="false">Contact</x-nav-link>
    <x-nav-link href="/players" :active="false">Players</x-nav-link>
</nav>

{{ $slot }}
</body>
</html>
