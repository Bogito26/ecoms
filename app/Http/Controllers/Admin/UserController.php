<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Display all users
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    // Show edit form
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update user info including profile picture
   public function update(Request $request, User $user)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email',
        'role'  => 'required|in:admin,customer',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Update basic fields
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    // Profile picture upload
    if ($request->hasFile('profile_picture')) {
        // Delete old picture if exists
        if ($user->profile_picture && Storage::disk('public')->exists('profile_pictures/' . $user->profile_picture)) {
            Storage::disk('public')->delete('profile_pictures/' . $user->profile_picture);
        }

        $file = $request->file('profile_picture');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Save file to public disk
        $file->storeAs('profile_pictures', $filename, 'public');

        // Save filename in DB
        $user->profile_picture = $filename;
    }

    // Save all changes
    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
}


    // Toggle active/inactive
    public function toggleStatus(User $user)
    {
        if (auth()->id() == $user->id) {
            return back()->with('error', "You can't deactivate your own account.");
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'User status updated.');
    }

    // Delete user
    public function destroy(User $user)
    {
        if (auth()->id() == $user->id) {
            return back()->with('error', "You can't delete your own account.");
        }

        if ($user->profile_picture && Storage::disk('public')->exists('profile_pictures/' . $user->profile_picture)) {
            Storage::disk('public')->delete('profile_pictures/' . $user->profile_picture);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
