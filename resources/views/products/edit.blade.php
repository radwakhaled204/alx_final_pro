<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Product</title>
</head>
<body>
    @php
        $categories=App\Models\Category::all();
    @endphp
    <h1>Create Product</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="Post" action="{{route('products.update',$product)}}">
        @csrf
        @method('PATCH')
        <label for="name">Name:</label>
        <input name="name" id="name" type="text" value="{{$product->name}}">
        <br>
        <label for="name">Description:</label>
        <textarea name="description" id="description" cols="30" rows="10">
            {{$product->description}}
        </textarea>
        <br>
        <label for="price">Price:</label>
        <input name="price" id="price" type="number" value="{{$product->price}}">
        <br>
        <label for="category">Category:</label>

        <select name="category">
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>

            @endforeach
        </select>

        <button type="submit">Update</button>
    </form>
</body>
</html>