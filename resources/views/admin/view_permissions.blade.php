
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

