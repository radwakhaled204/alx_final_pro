<!DOCTYPE html>
<html lang="en">
<!--Index By Radwa Khaled-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Carts</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>

    <h1>All Carts</h1>
    @foreach ($cart as $cart)
        <div>
            <h2>Cart ID: {{ $cart->id }}</h2>
            <p>Total Quantity: {{ $cart->total_quantity }}</p>
            <p>Total Price: {{ $cart->total_price }}</p>
            <h3>Items:</h3>
            <ul>
                @foreach ($cart->items as $item)
                    <li>
                        Product Name: {{ $item->product->name }} <br>  
                        Quantity: {{ $item->quantity_to_purchase }} <br>
                        Total Price: {{ $item->total_item_price }}
                        <form action="{{ route('cart-items.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity_to_purchase" value="{{ $item->quantity_to_purchase }}">
                            <button type="submit">Update</button>
                        </form>
                        <form action="{{ route('cart-items.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Remove</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach

</body>
