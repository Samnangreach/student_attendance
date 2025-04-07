<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
</head>
<body>
    <h1>Search Results</h1>
    <ul>
        @forelse($items as $item)
            <li>{{ $item->first_name }}: {{ $item->last_name }}</li>
        @empty
            <li>No items found.</li>
        @endforelse
    </ul>
    <a href="/search">Back to Search</a>
</body>
</html>
