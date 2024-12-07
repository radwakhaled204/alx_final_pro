<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Product</title>
    <link rel="stylesheet" href="{{ asset('css/createproduct.css') }}">
</head>

<body>
    @php
        $categories = App\Models\Category::all();
    @endphp
    <div class="container">
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

        <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data" class="form">
            @csrf

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="images[]" id="image" multiple accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input name="name" id="name" type="text" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input name="price" id="price" type="number" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-submit">Create</button>
        </form>
    </div>
</body>

</html>