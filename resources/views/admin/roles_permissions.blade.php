
<div class="card mt-4">
    <div class="card-header">
        Managing Roles and Permissions
    </div>
    <div class="card-body">
        <h5>Manage Roles:</h5>

        <!-- Example: View Roles -->
        <a href="{{ route('admin.view_roles') }}" class="btn btn-primary">View Roles</a>

        <!-- Example: Create Role -->
        <form action="{{ route('admin.create_role') }}" method="post" class="mt-2">
            @csrf
            <label for="role_name">Create New Role:</label>
            <input type="text" name="role_name" id="role_name" class="form-control" required>
            <button type="submit" class="btn btn-success">Create Role</button>
        </form>

        <hr>

        <a href="{{ route('admin.view_permissions') }}" class="btn btn-primary">View Permissions</a>

       
    </div>
</div>
