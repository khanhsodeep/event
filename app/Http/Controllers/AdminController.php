<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function getLoginAdmin(Request $request)
    {
        if ($request->session()->has('auth')) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('admin/login');
        }
    }

    public function postLoginAdmin(Request $request)
    {
        $email = $request->email;
        $user = DB::table('users')->where('email', $email)->first();
        if ($user && password_verify($request->password, $user->password) && $user->role_id == 1) {
            $request->session()->put('auth', $user);
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with('alert_error', 'Bạn không có quyền truy cập.');
        }
    }

    public function getDashboard()
    {
        return view('layouts.admin.master');
    }

    public function getAdminLogout(Request $request) {
        $request->session()->forget('auth');
        return redirect()->route('admin.login');
    }
}
