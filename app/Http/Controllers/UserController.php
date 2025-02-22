<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobInformation;
use App\Models\JobStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function list(){
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        $data = compact('users');
        return view('admin.users.list')->with($data);
    }

    public function add(){
        return view('auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'size:6', 'regex:/^\d{6}$/'],  // Only 6 digits
            'designation' => ['required', 'string', 'max:255'],
        ]);
    
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'designation' => $request->designation,
        ]);

        return redirect()->route('user.list')->with('success', 'User Added Successfully.');
    }

    public function edit($id){
        $user = User::find($id);
        $data = compact('user');

        return view('admin.users.edit')->with($data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id], // Ignore current user's email
            'password' => ['nullable', 'size:6', 'regex:/^\d{6}$/'], // Only 6 digits, optional
            'designation' => ['required', 'string', 'max:255'],
        ]);

        // Find user by ID
        $user = User::findOrFail($id);

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->designation = $request->designation;

        // Update password only if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the updated user
        $user->save();

        return redirect()->route('user.list')->with('success', 'User updated successfully.');
    }


    public function delete($id){
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        $user->delete();
        return redirect()->route('user.list')->with('success', 'User deleted successfully.');
    }

}
