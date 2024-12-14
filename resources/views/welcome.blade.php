<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="app-name">www.Commerce.buy</div>
        @guest
            <div class="auth-buttons">
                <button onclick="location.href='{{ route('login') }}'">Login</button>
                <button onclick="location.href='{{ route('register') }}'">Sign Up</button>
            </div>
        @endguest
        @auth
            <div class="auth-buttons">
                <div style="padding: 10px">{{ Auth::user()->name }}</div>
               <!-- <div style="padding: 10px">{{ Auth::user()->id }}</div>----debug--> 
                <button onclick="location.href='{{ route('cart.index') }}'">View Cart</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        @endauth
    </nav>

    <div class="products-container">
        <h1>Our Products</h1>
        <div class="product-list">
        @foreach ($products as $product)
    @if ($product->inventory > 0)
        <div class="product-card">
            <a href="{{ route('products.show', $product->id) }}" class="product-link">
                @if ($product->images->isNotEmpty())
                    <img src="{{ asset('upload/products/' . $product->images->first()->image_name) }}" alt="{{ $product->name }}" class="product-image" />
                @else
                    <img src="{{ asset('upload/products/default.png') }}" alt="Default Image" class="product-image" />
                @endif
                <h2>{{ $product->name }}</h2>
            </a>

            @if ($product->price)
                <p class="product-price">${{ number_format($product->price, 2) }}</p>
            @endif

            @if(Auth::check())
                <form action="{{ route('cart-items.store') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="number" name="quantity_to_purchase" value="1" min="1" required>
                    <button type="submit" class="add-to-cart-button">Add to Cart</button>
                </form>
            @else
                <button onclick="location.href='{{ route('login') }}'" class="add-to-cart-button">Add to Cart</button>
            @endif
        </div>
    @endif
@endforeach



        </div>
    </div>
</body>

</html>