<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Products</title>
    @vite('resources/css/index.css')
</head>
<body>

    <header>
        <h1><a href="{{ route('products.create') }}">Create Product</a></h1>
    </header>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Images</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <!-- Display product images -->
                        <td>
                            @forelse($product->images as $image)
                                <img src="{{ asset('upload/products/'.$image->image_name) }}" alt="{{ $product->name }}" width="100" style="margin-right: 5px;">
                            @empty
                                No Images Available
                            @endforelse
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td class="actions">
                            <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                            <form method="POST" action="{{ route('products.destroy', $product) }}" style="display:inline-block;">
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
