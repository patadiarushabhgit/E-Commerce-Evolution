<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {


        $users = User::all();


        $roles = Role::all();

        return view('user.index', compact('users', 'roles'));
    }


    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'roles' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => ['required', 'string', Password::min(8)->letters()->numbers()->mixedCase()->symbols()]

    //     ]);

    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->assignRole($request->input('roles'));
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);
    //     $user->save();



    //     return redirect()->route('user.index')
    //         ->with('success', 'User created successfully.');
    // }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'roles' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', Password::min(8)->letters()->numbers()->mixedCase()->symbols()]
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);


        $user->roles = $request->input('roles');
        $user->assignRole($request->input('roles'));
        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'User created successfully.');
    }



    public function show(User $user)
    {
        $roles = Role::all();

        return view('user.show', compact('user', 'roles'));
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        $userrole = $user->roles;
        return view('user.edit', compact('user', 'roles', 'userrole'));
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
            'role' => 'required',
            'email' => 'required|email',

        ]);


        // Update the user's other fields
        $user->name = $request->name;
        $user->roles = $request->role;
        $user->email = $request->email;





        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully.');
    }
    public function edit_profile(Request $request)
    {

        $user = DB::table('users')->where('id', Auth::user()->id)->value('name', 'email');
        $user = [
            'name' => $request->name,
            'email' => $request->email
        ];

        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update($user);

        return redirect()->route('view_profile')
            ->with('success', 'User updated successfully.');
    }
    public function view_profile(User $user)
    {
        $user = User::where('id', Auth::user()->id)->first();


        return view('auth.view_profile', compact('user'));
    }

    public function set_password(Request $request, User $user)
    {
        $request->validate([
            'old_password' => 'required',
            'new-password' => ['required', 'string', Password::min(8)->letters()->numbers()->mixedCase()->symbols()],
            'confirm_password' => 'required|same:new_password',
        ]);
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['message' => 'invalid old password.'], 422);
        }
        //check is old password and new are same
        if ($request->old_password === $request->new_password) {
            return response()->json(['message' => 'old and new password cannot be same.'], 422);
        }
        //update users password
        $user = [
            'password' => Hash::make($request->new_password),
        ];
        Db::table('users')
            ->where('id', Auth::user()->id)
            ->update($user);
        return response()->json(['success' => true]);
    }

    public function getUser(Request $request)
    {
        // Read value
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');

        $searchValue = $request->input('search.value');

        // Total records
        $totalRecords = User::count();

        // Apply search filter
        $filteredRecords = User::where('name', 'like', '%' . $searchValue . '%')
            ->count();

        // Fetch records with pagination and search
        $records = User::where('name', 'like', '%' . $searchValue . '%')
            ->orderBy('id', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        $data = [];
        $counter = $start + 1;

        foreach ($records as $record) {


            $row = [
                $counter,
                $record->name,
                $record->email,
                $record->roles,

                '<a href="' . route('user.edit', $record->id) . '" class="btn"><i class="fa-regular fa-pen-to-square"></i></a>&nbsp;' .
                    '<a href="' . route('user.show', $record->id) . '" class="btn"><i class="fa-solid fa-eye"></i></a>&nbsp;' .
                    '<form action="' . route('user.destroy', $record->id) . '" method="POST" style="display:inline">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn"><i class="fa-solid fa-trash-can"></i></button>
                    </form>'
            ];

            $data[] = $row;
            $counter++;
        }

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ];

        return response()->json($response);
    }
}
