@extends('layouts.app')

@section('content')
    <h2>Edit User</h2>
    
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->ID) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 15px;">
            <label>Full Name:</label><br>
            <input type="text" name="FullName" value="{{ old('FullName', $user->FullName) }}" required>
        </div>
        <div style="margin-bottom: 15px;">
            <label>Username:</label><br>
            <input type="text" name="Username" value="{{ old('Username', $user->Username) }}" required>
        </div>
        <div style="margin-bottom: 15px;">
            <label>Password (Leave blank to keep current password):</label><br>
            <input type="password" name="Password">
        </div>
        <div style="margin-bottom: 15px;">
            <label>Role:</label><br>
            <select name="Role" required>
                <option value="Cashier" {{ old('Role', $user->Role) == 'Cashier' ? 'selected' : '' }}>Cashier</option>
                <option value="Inventory Clerk" {{ old('Role', $user->Role) == 'Inventory Clerk' ? 'selected' : '' }}>Inventory Clerk</option>
                <option value="Owner/Admin" {{ old('Role', $user->Role) == 'Owner/Admin' ? 'selected' : '' }}>Owner/Admin</option>
            </select>
        </div>
        <button type="submit">Update User</button>
        <a href="{{ route('users.index') }}">Cancel</a>
    </form>
@endsection