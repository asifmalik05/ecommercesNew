<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = User::where('email', $request->email)
            ->where('is_admin', true)
            ->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            return back()
                ->withErrors(['email' => 'Invalid admin credentials.'])
                ->withInput();
        }

        $request->session()->put('admin_user_id', $admin->id);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_user_id');

        return redirect()->route('admin.login');
    }
}