<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
      body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        }

        .sidebar {
        height: 100vh;
        background-color: #343a40;
        color: white;
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        padding-top: 20px;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease;
        }

        .sidebar.hide {
        transform: translateX(-100%);
        }

        .sidebar a {
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        display: block;
        }

        .sidebar a:hover {
        background-color: #575757;
        }

        .sidebar .logout {
        margin-top: 270px;
        }

        .toggle-sidebar {
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 999;
        background-color: #343a40;
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        }

        .container {
            transition: margin-left 0.3s ease, width 0.3s ease;
            margin-left: 270px;
            width: calc(100% - 270px); 
        }

        .container.shifted {
            margin-left: 20px;
            width: calc(100% - 20px); 
        }

        .card {
        margin-top: 20px;
        }
    </style>
  </head>
  <body>
        <button class="toggle-sidebar" onclick="toggleSidebar()">☰</button>

        
        <div class="sidebar" id="sidebar">
            <h3 class="text-center mb-4 mt-5">Admin Panel</h3>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('products.create') }}">Accounts</a>
            <a href="{{ route('products.create') }}">Add Product</a>
            <a href="{{ route('account.logout') }}" class="logout">Logout</a>
        </div>

        
        <div class="container sidebar-hidden" id="content">
            <div class="row justify-content-center mt-5">
                <div class="col-md-10">
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                    <div class="card shadow-lg ">
                        <div class="card-header bg-dark text-white text-center">
                            <h3>Registered Accounts</h3>
                        </div>
                        <div class="card-body ">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($users->isNotEmpty())
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            <a href="{{ route('account.edited', $user->id) }}" class="btn btn-dark">Edit</a>
                                            <a href="#" onclick="deleteUser({{ $user->id }})" class="btn btn-danger">Delete</a>
                                            <form id="delete-user-form-{{ $user->id }}" action="{{ route('account.delete', $user->id) }}" method="post" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No registered accounts found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");

            sidebar.classList.toggle("hide");
            content.classList.toggle("shifted");

            // Adjust width dynamically when toggling
            if (sidebar.classList.contains("hide")) {
                content.style.width = "calc(100% - 20px)";
            } else {
                content.style.width = "calc(100% - 270px)";
            }
        }

            function deleteUser(id) {
            if (confirm("Are you sure you want to delete this account?")) {
            document.getElementById("delete-user-form-" + id).submit();
            }
        }
        </script>
  </body>
</html>
