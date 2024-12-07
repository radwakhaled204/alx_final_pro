<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Categories</title>
    @vite('resources/css/index.css')
</head>
<body>

    <header>
        <h1><a href="{{ route('categories.create') }}">Create Category</a></h1>
    </header>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>       
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <!-- Check if the category has an image -->
                            @if($category->image)
                                <img src="{{ asset('upload/categories/'.$category->image) }}" alt="{{ $category->name }}" width="100"> <!-- Display the image -->
                            @else
                                No Image Available
                            @endif
                        </td>
                        <td class="actions">
                            <a href="{{ route('categories.edit', $category) }}">Edit</a>
                            <a href="{{ route('categories.show', $category->id) }}">View</a>

                            <form method="POST" action="{{ route('categories.destroy', $category) }}" style="display:inline-block;">
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
