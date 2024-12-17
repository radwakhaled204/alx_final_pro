<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: 'arial', sans-serif;
            background: #F9F3EC;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            max-width: 800px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
        }

        h1, h2, h3 {
            color: #dead6f;
        }

        h1 {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 30px;
        }

        h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 1.5rem;
            margin-top: 20px;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            padding: 15px;
            margin-bottom: 10px;
            background: #f7f5f2;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #F9F3EC;
            color: black;
            font-size: 1.1rem;
            border: 1px solid #583e3e;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #DEAD6F;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Invoice</h1>

        <p><strong>User Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <h2>Products</h2>
        <ul>
            @foreach ($cart->items as $item)
                <li>
                    <p><strong>Product Name:</strong> {{ $item->product->name }}</p>
                    <p><strong>Quantity:</strong> {{ $item->quantity_to_purchase }}</p>
                    <p><strong>Price:</strong> ${{ number_format($item->product->price, 2) }}</p>
                    <p><strong>Total Price:</strong> ${{ number_format($item->quantity_to_purchase * $item->product->price, 2) }}</p>
                </li>
            @endforeach
        </ul>

        <h3><strong>Total Quantity:</strong> {{ $cart->total_quantity }}</h3>
        <h3><strong>Total Price:</strong> ${{ number_format($totalPrice, 2) }}</h3>

        <form action="{{ route('order.place') }}" method="POST">
            @csrf
            <button type="submit">Place Order</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
