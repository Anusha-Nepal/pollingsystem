<html>
    <head>
        <style>
            /* Container Styling */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

/* Table Styling */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

/* Table Header Styling */
.table th {
    background-color: #007bff;
    color: #fff;
    padding: 10px;
    text-align: left;
}

/* Table Cell Styling */
.table td {
    border: 1px solid #ddd;
    padding: 10px;
}

/* Button Styling */
.btn-primary {
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 4px;
    display: inline-block;
    font-size: 16px;
    margin-top: 20px;
}

.btn-primary:hover {
    background-color: #0056b3;
}

        </style>

    </head>
</body>
    <div class="container">
        <h2>Permissions List</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>route_name</th>
                    <th>common_name</th>
                    <th>group_name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->route_name }}</td>
                        <td>{{$permission->common_name}}</td>
                        <td>{{$permission->group_name}}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
</div>
    </div>
</body></html>

