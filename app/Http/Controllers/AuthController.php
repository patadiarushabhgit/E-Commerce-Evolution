<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Exists;





class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function validateRegForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'string', Password::min(8)->letters()->numbers()->mixedCase()->symbols()]
        ]);

        if ($validator->passes()) {
            // Create the user and add to the database
            $user = DB::table('users')->insertGetId([
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            if ($user) {
                Session::put('username', $request->username);
                return redirect('/admin/index');
            }
        }

        return response()->json(['error' => $validator->errors()]);
    }

    public function validateLoginForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            $user = DB::table('users')->where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                Session::put('username', $user->name);
                Session::put('id', $user->id);
                return redirect('/admin/index');
            }

            return response()->json(['failed' => 'Invalid email or password!']);
        }

        return response()->json(['error' => $validator->errors()]);
    }
    public function index(){
        return view('admin/index');
    }
    public function logout(Request $request)
    {
        Session::forget('username');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }


}
