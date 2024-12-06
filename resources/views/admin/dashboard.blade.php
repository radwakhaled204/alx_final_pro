
                    <h3>Admin Dashboard</h3>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
    
                        <button type="submit">Logout</button>
                    </form>

