<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Display the form to create a new user
    public function create()
    {
        $roles = Role::all(); // Fetch all roles
        return view('users.create', compact('roles'));    }

    // Add a new user in the database
    public function add(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'user' => 'required|string|max:255|unique:users',
        'password' => 'required|string|min:5',
        'role' => 'required|string|exists:roles,name',
    ]);

    // Create the user
    $user = User::create([
        'name' => $validatedData['name'],
        'user' => $validatedData['user'],
        'password' => bcrypt($validatedData['password']),
    ]);

    // Assign the role
    $user->assignRole($validatedData['role']);

    return redirect()->route('users.index')->with('success', 'تمت إضافة مستخدم بنجاح.');
}

    // Display the form to edit a user
    public function edit($id)
{
    $user = User::findOrFail($id); // Retrieves the user or throws a 404 error if not found
    return view('users.edit', compact('user')); // Pass the user to the edit view
}

    // Update the user in the database
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'user' => 'required|string|max:255',
            'password' => 'nullable|string|min:5|confirmed', // Assuming you want confirmation for the password field
        ]);

        $user->name = $request->name;
        $user->user = $request->user;

        // Only update password if it's provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'تم تحديث المستخدم بنجاح'); // Success message in Arabic
    }

    // Delete a user
    public function Delete(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    // List all users
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }
}
