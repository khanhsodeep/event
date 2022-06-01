<?php

namespace App\Http\Controllers;

use App\createEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 2; // Default is 1
    public function getLoginAdmin(Request $request)
    {

        if ($request->session()->has('auth')) {
            return redirect()->route('admin.dashboard.dashboard');
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
            return redirect()->route('admin.dashboard.dashboard');
        } else {
            return redirect()->route('admin.login')->with('alert_error', 'Bạn không có quyền truy cập.');
        }
    }

    public function getDashboard(Request $request)
    {
        $events = createEvent::all();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
    
        $event_favourites = DB::table('event')->orderBy('time', 'DESC')->orderBy('member','DESC')->where('status', 1)->where('event.time','<',$today)->take(1)->get();
        $data = [
            'events' => $events
        ];
        $counts = DB::table('event')->count();
        $countuser = DB::table('users')->count();
        $countuser_create = DB::table('event')->addSelect(DB::raw('email'))->addSelect(DB::raw('count(event.id) as total'))->groupBy('user_id','email')->orderByDesc('total')->join('users','event.user_id','=','users.id')->take(1)->get();
        $countstatus = DB::table('event')->addSelect(DB::raw('count(*) as total'))->where('status','=', '1')->get();
        $countstatus_non = DB::table('event')->addSelect(DB::raw('count(*) as total'))->where('status','=', '0')->get();
        if ($request->session()->has('auth')) {
            return view('admin.dashboard.dashboard',$data)->with(compact('counts','event_favourites','countuser','countuser_create','countstatus','countstatus_non'));
        } else {
            return redirect()->route('admin.login');
        }
        }


    public function getAdminLogout(Request $request)
    {
        $request->session()->forget('auth');
        return redirect()->route('admin.login');
    }
}
