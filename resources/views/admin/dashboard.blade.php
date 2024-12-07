<h3>Admin Dashboard</h3>
<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <h1><a href="{{ route('products.index') }}">Manage Products</a></h1>
    <h1><a href="{{ route('categories.index') }}">Manage categories</a></h1>



    <button type="submit">Logout</button>
</form>