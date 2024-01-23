
<html>
    <head>
        <style>
            
.card {
    width: 400px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

/* Card Header Styling */
.card-header {
    background-color: #007bff;
    color: #fff;
    padding: 10px;
    text-align: center;
    border-radius: 8px 8px 0 0;
}

/* Card Body Styling */
.card-body {
    padding: 20px;
}

/* Form Styling */
form {
    margin-top: 15px;
}

/* Label Styling */
label {
    margin-bottom: 5px;
    display: block;
    font-weight: bold;
}

/* Select Styling */
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
}

/* Button Styling */
button {
    background-color: #28a745;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #218838;
}

/* Primary Button Styling */
.btn-primary {
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 4px;
    display: inline-block;
    font-size: 16px;
}

.btn-primary:hover {
    background-color: #0056b3;
}

            </style>
    </head>
    <body>
        <div class="card mt-4">
            @include('admin.roles_permissions')
            <div class="card-header">
                Managing Users, Roles, and Permissions
            </div>
            <div class="card-body">
                <h5>Assign Roles to Users:</h5>
                <form action="{{ route('admin.user_roles') }}" method="post" class="mt-2">
                    @csrf
                    <label for="user_id">Select User:</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <!-- Populate this dropdown with existing users -->
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>

                    <label for="role_id">Select Role:</label>
                    <select name="role_id" id="role_id" class="form-control" required>
                        <!-- Populate this dropdown with existing roles -->
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-success">Assign Roles</button>
                </form>

                <h5 class="mt-4">Assign Permissions to Roles:</h5>
                <form action="{{ route('admin.assign_permission') }}" method="post" class="mt-2">
                    @csrf
                    <label for="role_id_permission">Select Role:</label>
                    <select name="role_id" id="role_id_permission" class="form-control" required>
                        <!-- Populate this dropdown with existing roles -->
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>

                    <div class="mt-2">
                        <label>Select Permissions:</label>
                        <!-- Display permissions as checkboxes -->
                        @foreach($permissions as $permission)
                            <div>
                                <input type="checkbox" name="permission_ids[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}">
                                <label for="permission_{{ $permission->id }}">{{ $permission->route_name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-success">Assign Permissions</button>
                </form>

                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-4">Go to Dashboard</a>
            </div>
        </div>
    </body>
</html>
