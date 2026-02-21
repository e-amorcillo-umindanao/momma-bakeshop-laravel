@extends('layouts.app')

@section('content')
    <h2>Create New User</h2>
    
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label>Full Name:</label><br>
            <input type="text" name="FullName" value="{{ old('FullName') }}" required>
        </div>
        <div style="margin-bottom: 15px;">
            <label>Username:</label><br>
            <input type="text" name="Username" value="{{ old('Username') }}" required>
        </div>
        <div style="margin-bottom: 15px;">
            <label>Password:</label><br>
            <input type="password" name="Password" required>
        </div>
        <div style="margin-bottom: 15px;">
            <label>Role:</label><br>
            <select name="Role" required>
                <option value="">Select Role</option>
                <option value="Cashier" {{ old('Role') == 'Cashier' ? 'selected' : '' }}>Cashier</option>
                <option value="Inventory Clerk" {{ old('Role') == 'Inventory Clerk' ? 'selected' : '' }}>Inventory Clerk</option>
                <option value="Owner/Admin" {{ old('Role') == 'Owner/Admin' ? 'selected' : '' }}>Owner/Admin</option>
            </select>
        </div>
        <button type="submit">Create User</button>
        <a href="{{ route('users.index') }}">Cancel</a>
    </form>
@endsection