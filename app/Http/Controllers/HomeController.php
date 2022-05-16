<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Newsletter;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
        public function subscribe(Request $request)
        {
            $request->validate(['email' => 'required|email']);
            try {
                if (Newsletter::isSubscribed($request->email)) {

                    return redirect()->back()->with('error', 'Email đã đăng ký nhận tin rồi!');
                } else {
                    Newsletter::Subscribe($request->email);
                    return redirect()->back()->with('success', 'Đăng ký nhận tin thành công!');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    public function index()
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $event_hot = DB::table('event')->where('status', 1)->take(6)->orderBy('id', 'DESC')->get();
        $event_favourite = DB::table('event')->orderBy('time','DESC')->where('status', 1)->where('event.time','>',$today)->Orwhere('event.time','<',$today)->take(3)->get();
       
        $data = [
            'event_hot' => $event_hot,
            'event_favourite' => $event_favourite,
         
        ];
        return view('home', $data);
    }

    public function userProfile()
    {
        // $user_event = DB::table('event')->where('user_id', Auth::user())->orWhere('id', $id)->first();
        // if(!$user_event) {
        //     return redirect()->back()->with('alert_error', 'Thông tin sự kiện không tồn tại.');
        // }
        $user = Auth::user();
        $list_event_participation = DB::table('event')->join('ticket', 'event.id', '=', 'ticket.event_id')->where('ticket.user_id', Auth::user()->id)->get();
        $event = DB::table('event')->where('user_id', Auth::user()->id)->get();
        $categoryList = DB::table('categories')->get();
        $data = [
            'event' => $event,
            'user' => $user,
            'list_event_participation' => $list_event_participation,
            'categoryList' => $categoryList,
        ];
        return view('users.profile', $data);
    }
}
