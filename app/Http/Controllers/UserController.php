<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = User::query();

        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }

        $users = $query->latest()->paginate(5);
        Paginator::useBootstrap();

        return view('user.index', compact('users', 'search'))
            ->with('i', ($users->currentPage() - 1) * 5);
    }


    public function create()
    {
        return view('user.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required','string',Password::min(8)->letters()->numbers()->mixedCase()->symbols()]

        ]);

        $input = $request->all();



        User::create($input);

        return redirect()->route('user.index')
            ->with('success', 'User created successfully.');
    }


    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }


    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',

        ]);


        // Update the user's other fields
        $user->name = $request->name;
        $user->email = $request->email;

        // Check if a new image file is uploaded


        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully.');
    }
}
