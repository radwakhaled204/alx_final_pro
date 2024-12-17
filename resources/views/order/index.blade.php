<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Products</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<style>
    .container {
        max-width: 1000px;
        margin: auto;
        padding: 20px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tbody tr:hover {
        background-color: #f1f1f1;
    }

    ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .actions form {
        display: inline-block;
    }

    .delete-btn {
        background-color: #e74c3c;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 3px;
    }

    .delete-btn:hover {
        background-color: #c0392b;
    }
</style>

<body style="background:#F9F3EC">
    <!-- Navigation bar -->
    <nav>
        <div class="left-nav">
            <a class="nav-text" href="{{ route('categories.index') }}">Manage Categories</a>
            <a class="nav-text" href="{{ route('products.index') }}">Manage Products</a>
            <a class="nav-text" href="{{ route('order.index') }}">Manage Orders</a>
        </div>
        <div class="right-nav">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" style="color:white; background-color:#e0b178">Logout</button>
            </form>
        </div>
    </nav>

<div class="container">
    <h1>All Orders</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Total Price</th>
                <th>Order Items</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>${{ number_format($order->total_item_price, 2) }}</td>
                    <td>
                        <ul>
                            @foreach ($order->orderItems as $item)
                                <li>
                                    {{ $item->product->name }} ({{ $item->quantity_to_purchase }}) - ${{ number_format($item->total_item_price, 2) }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="actions">
                        <!-- Delete Order -->
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this order?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    </body>

</html>