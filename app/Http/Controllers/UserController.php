<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        return view('create-user-view');
    }

    public function create(Request $request)
    {

        //Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:librarian,member'],
        ]);


        // Simpan data user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'phone' => $request->phone
        ]);

        return redirect()->route('users-index')->with('success', 'Registration successful!');
    }



    public function usershow()
    {
        //Mengambil semua data user
        $users = User::all();
        return view('user-view', compact('users'));
    }

    public function edit(User $user)
    {
        return view('edit-user-view', compact('user'));
    }

    //Update Register
    public function update(Request $request, User $user)
    {
        // dd($user);
        //Validasi input
        $validatedData =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:librarian,member'],
        ]);

        // $user = User::findOrFail($request->id);
        $user->update($validatedData);

        // Update data user
        // $user->name = $validatedData['name'];
        // $user->email = $validatedData['email'];
        // $user->role = $validatedData['role'];
        // $user->phone = $validatedData['phone'];
        // $user->password = Hash::make($validatedData['password']);
        // $user->save();



        return redirect()->route('users-index')->with('success', 'Registration successful!');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users-index')->with('success', 'Registration successful!');
    }
}
