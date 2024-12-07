<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Category</title>
    @vite('resources/css/index.css') <!-- Make sure you link the correct CSS file -->
</head>
<body>

    <header>
        <h1>Edit Category</h1>
        <a href="{{ route('categories.index') }}">Back to Categories</a>
    </header>

    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This tells Laravel to use the PUT method -->

            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required>
            </div>

            <div class="form-group">
                <label for="image">Category Image:</label>
                <!-- Display current image if it exists -->
                @if($category->image)
                    <div class="current-image">
                        <img src="{{ asset('upload/categories/'.$category->image) }}" alt="{{ $category->name }}" width="150">
                    </div>
                @else
                    <p>No image available</p>
                @endif
                <input type="file" name="image" id="image">
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">Update Category</button>
            </div>
        </form>
    </div>

</body>
</html>
