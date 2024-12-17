<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Category</title>

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
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
        }

        h1 {
            font-size: 2.5rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 1.1rem;
            color: #333;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
            margin-top: 5px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #F9F3EC;
            color: black;
            font-size: 1.1rem;
            border: 1px solid #583e3e;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #DEAD6F;
        }

        .current-image img {
            max-width: 150px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #333;
            text-decoration: none;
            font-size: 1rem;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 style="color:#dead6f">Edit Category</h1>

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
                        <img src="{{ asset('upload/categories/' . $category->image) }}" alt="{{ $category->name }}">
                    </div>
                @else
                    <p>No image available</p>
                @endif
                <input type="file" name="image" id="image" accept="image/*">
            </div>

            <button type="submit" class="btn-submit">Update Category</button>
        </form>

        <a href="{{ route('categories.index') }}">Back to Categories</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
