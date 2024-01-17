<div class="card mt-4">
    <div class="card-header">
        Managing Users and Roles
    </div>
    <div class="card-body">
        <h5>Assign Roles to Users:</h5>

        <!-- Example: Assign Roles to Users -->
        <form action="{{ route('admin.assign_roles') }}" method="post" class="mt-2">
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
 <form action="{{ route('admin.assign_permission') }}" method="post" class="mt-2">

            @csrf
            <label for="role_id">Select Role:</label>
            <select name="role_id" id="role_id" class="form-control" required>
                <!-- Populate this dropdown with existing roles -->
                
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>

            <label for="permission_id">Select Permission:</label>
            <select name="permission_id" id="permission_id" class="form-control" required>
                
                <!-- Populate this dropdown with existing permission -->
                @if(isset($permissions))
                @foreach($permissions as $permission)
                <option value="{{ $permission->id }}">{{ $permission->route_name}}</option>

            @endforeach
@endif
            </select> 

            <button type="submit" class="btn btn-success">Assign permission</button>
        </form>
    <div>
</div>
