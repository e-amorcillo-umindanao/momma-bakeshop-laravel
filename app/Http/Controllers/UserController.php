<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Helper function to log audit
    private function logAudit($tableEdited, $action, $previousChanges, $savedChanges)
    {
        Audit::create([
            'UserID' => Auth::id(),
            'TableEdited' => $tableEdited,
            'PreviousChanges' => $previousChanges ? json_encode($previousChanges) : null,
            'SavedChanges' => $savedChanges ? json_encode($savedChanges) : null,
            'Action' => $action,
            'DateAdded' => now(),
        ]);
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'FullName' => 'required|string|max:255',
            'Username' => 'required|string|max:255|unique:Users,Username',
            'Password' => 'required|string|min:6',
            'Role' => 'required|string|in:Cashier,Inventory Clerk,Owner/Admin',
        ]);

        $user = User::create([
            'FullName' => $validated['FullName'],
            'Username' => $validated['Username'],
            'Password' => Hash::make($validated['Password']),
            'Role' => $validated['Role'],
            'Status' => 'Active',
            'DateAdded' => now(),
            'DateModified' => now(),
        ]);

        $this->logAudit('Users', 'INSERT', null, $user->toArray());

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'FullName' => 'required|string|max:255',
            'Username' => 'required|string|max:255|unique:Users,Username,' . $user->ID . ',ID',
            'Role' => 'required|string|in:Cashier,Inventory Clerk,Owner/Admin',
        ]);

        $previous = $user->toArray();

        $user->FullName = $validated['FullName'];
        $user->Username = $validated['Username'];
        $user->Role = $validated['Role'];
        $user->DateModified = now();

        if ($request->filled('Password')) {
            $user->Password = Hash::make($request->Password);
        }

        $user->save();

        $this->logAudit('Users', 'UPDATE', $previous, $user->toArray());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function deactivate(User $user)
    {
        // Prevent deactivating the last active Owner/Admin
        if ($user->Role === 'Owner/Admin') {
            $adminCount = User::where('Role', 'Owner/Admin')->where('Status', 'Active')->count();
            if ($adminCount <= 1 && $user->Status === 'Active') {
                return redirect()->route('users.index')->with('error', 'Cannot deactivate the last active Owner/Admin.');
            }
        }

        $previous = $user->toArray();
        $user->Status = $user->Status === 'Active' ? 'Inactive' : 'Active';
        $user->DateModified = now();
        $user->save();

        $this->logAudit('Users', 'UPDATE', $previous, $user->toArray());

        $statusMessage = $user->Status === 'Active' ? 'activated' : 'deactivated';
        return redirect()->route('users.index')->with('success', "User successfully {$statusMessage}.");
    }

    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'FullName' => 'required|string|max:255',
            'Username' => 'required|string|max:255|unique:Users,Username,' . $user->ID . ',ID',
            'Password' => 'nullable|string|min:6|confirmed',
        ]);

        $previous = $user->toArray();

        $user->FullName = $validated['FullName'];
        $user->Username = $validated['Username'];
        $user->DateModified = now();

        if ($request->filled('Password')) {
            $user->Password = Hash::make($request->Password);
        }

        $user->save();

        $this->logAudit('Users', 'UPDATE', $previous, $user->toArray());

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}