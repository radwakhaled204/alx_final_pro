<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Products</title>
</head>
<body>
    <h1><a href="{{route('products.create')}}">Create Product</a></h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>

            </tr>
        </thead>
        @foreach ($products as $product )
            <thead>
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->category->name}}</td>
                    <td><a href="{{route('products.edit',$product)}}">Edit</a>
                        <form method="POST" action="{{route('products.destroy',$product)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>

                </tr>
            </thead>
        @endforeach
        
    </table>
</body>
</html>