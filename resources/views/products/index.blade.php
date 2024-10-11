<!-- resources/views/products/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>
<h1>Products</h1>
<ul>
    @if(isset($products) && $products->count())
        @foreach ($products as $product)
            <li>{{ $product->name }}</li>
        @endforeach
    @else
        <li>No products available</li>
    @endif
</ul>
</body>
</html>
