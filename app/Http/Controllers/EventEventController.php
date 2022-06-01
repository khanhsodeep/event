<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\User;
use App\createEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventEventController extends Controller
{
    public function getList(Request $request)
    {
        $events = createEvent::all();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $data = [
            'events' => $events,
            'today' => $today
        ];
        if ($request->session()->has('auth')) {
            return view('admin/event/list', $data);
        } else {
            return redirect()->route('admin.login');
        }
    }


    public function getAdd()
    {
        $categoryList = DB::table("categories")->get();
        $data = ['categoryList' => $categoryList];
        return view("admin/event/add", $data);
    }

    public function postAdd(Request $request)
    {
        $validateRules =$request->validate( [
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name' => 'required|min:6',
            'content' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'amount' => 'required|numeric',
            'time' =>'required|date|after:tomorrow',
            'address' => 'required',
        ]);
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $validator = Validator::make($request->all(), $validateRules);
        $fileName = auth()->id() . '_' . time() . '.' . $request->file('image')->extension();
        $request->file('image')->move(public_path('file'), $fileName);
        $auth = $request->session()->get('auth');
        $data = [
            'name_event' => $request->input('name'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
            'category_id' => $request->input('category_id'),
            'amount' => $request->input('amount'),
            'user_id' => $auth->id,
            'time' => $request->time,
            'address' => $request->address,
            'image' => $fileName,
            'today' => $today,
        ];

        DB::table('event')->insert($data);
        return redirect()->route('admin.event')->with('success', 'Tạo sự kiện thành công.');
    }

    public function getEdit($id)
    {
        $listCategory = DB::table('categories')->get();
        $event = DB::table("event")->where('id', '=', $id)->first();
        $data = ['event' => $event, 'listCategory' => $listCategory];
        return view("admin/event/edit", $data);
    }

    public function postEdit(Request $request, $id)
    {
        $request->validate( [
            'name' => 'required|min:6',
            'content' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'amount' => 'required|numeric',
            'time' => 'required|date|after:tomorrow',
            'address' => 'required',
        ]);
    ;
        if ($request->has('image') && $request->file('image')) {
            $event = DB::table('event')->where('id', $id)->limit(1);
            $fileName = auth()->id() . '_' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('file'), $fileName);
            $event->update([
                'name_event' => $request->input('name'),
                'content' => $request->input('content'),
                'status' => $request->input('status'),
                'category_id' => $request->input('category_id'),
                'amount' => $request->input('amount'),
                'time' => $request->time,
                'address' => $request->address,
                'image' => $fileName,
            ]);
            return redirect()->route('admin.event', ['id' => $id])->with('success', 'Cập nhật sự kiện thành công.');
        } else {
            $event = DB::table('event')->where('id', $id)->limit(1);
            $event->update([
                'name_event' => $request->input('name'),
                'content' => $request->input('content'),
                'status' => $request->input('status'),
                'category_id' => $request->input('category_id'),
                'amount' => $request->input('amount'),
                'time' => $request->time,
                'address' => $request->address,
            ]);
            return redirect()->route('admin.event', ['id' => $id])->with('success', 'Cập nhật sự kiện thành công.');
        }
    }

    public function getDelete($id)
    {
        DB::table('event')->where('id', $id)->delete();
        return redirect()->route('admin.event')->with('success', 'Xóa sự kiện thành công.');
    }
    public function DeleteTicket($id)
    {
        $event = DB::table('event')->join('ticket', 'event.id', '=', 'ticket.event_id')->where('ticket.id', $id)->first();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        if ($event->time < $today) {
            return redirect()->back()->with('warning', 'Sự kiện đã kết thúc.');
        } elseif ($event->status == 1) {
            return redirect()->back()->with('warning', 'Bạn đã điểm danh, không thể hủy vé.');
        } else {
            DB::table('event')->join('ticket', 'event.id', '=', 'ticket.event_id')->where('ticket.id', $id)
                ->update([
                    'amount' => DB::raw('amount+1'),
                    'member' => DB::raw('member-1'),
                ]);
            DB::table('ticket')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Huỷ tham gia thành công.');
        }
    }

    public function getEvent()
    {
        return view('event.view-event');
    }

    public function getEventDetail($id)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $event = DB::table('event')->where('id', $id)->first();
        $data = [
            'event' => $event,
            'today' => $today
        ];
        return view('event.view-event', $data);
    }

    public function postEventDetail($id)
    {


        $event = DB::table('event')->where('id', $id)->first();


        $user = (DB::table('ticket')->select('ticket.event_id')->join('users', 'users.id', '=', 'ticket.user_id')->join('event', 'event.id', '=', 'ticket.event_id'))->where('users.id', Auth::user()->id)->where('event.id', $id)->get();
        if (!empty($user)) {
            foreach ($user as $user) {
                if ($event->id == $user->event_id) {
                    return redirect()->back()->with('warning', 'Đã đăng ký sự kiện này.');
                }
            }
            DB::table('event')
                ->where('id', $id)
                ->update([
                    'member' => DB::raw('member + 1'),
                ]);
            DB::table('event')
                ->where('id', $id)
                ->update([
                    'amount' => DB::raw('amount-1'),
                ]);
            $data = [
                'code' => Str::random(10),
                'user_id' => Auth::user()->id,
                'event_id' => $event->id
            ];

            DB::table('ticket')->insert($data);
            return redirect()->back()->with('success', 'Tham gia sự kiện thành công.');
        }
    }

    public function getRankingEvent()
    {
        $event_favourite = DB::table('event')->orderBy('member', 'DESC')->take(3)->get();
    }

    public function getEventCategory($id)
    {
        $event = DB::table('event')->join('categories', 'event.category_id', '=', 'categories.id')->where('category_id', $id)->get();

        $event1 = DB::table('event')->orderBy('time', 'DESC')->select('event.id', 'image', 'time', 'address', 'name_event')->join('categories', 'event.category_id', '=', 'categories.id')->where('category_id', $id)->get();

        // dd($event);
        // if($event->name)

        return view('event.view-list-event', ['event' => $event, 'event1' => $event1]);
    }

    public function deleteEventUser($id)
    {
        $event = DB::table('event')->where('user_id', Auth::user())->orWhere('id', $id)->delete();
        if (!$event) {
            return redirect()->back()->with('error', 'Thông tin sự kiện không tồn tại.');
        }
        return redirect()->route('/home/profile')->with('success', 'Xoá sự kiện thành công.');
    }

    public function editEventUser($id)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $user = Auth::user();
        $list_event_participation = DB::table('event')->join('ticket', 'event.id', '=', 'ticket.event_id')->where('ticket.user_id', Auth::user()->id)->get();
        $event = DB::table('event')->where('user_id', Auth::user()->id)->get();
        // dd($event);
        $user_event = DB::table('event')->where('user_id', Auth::user())->orWhere('id', $id)->first();
        $listCategory = DB::table('categories')->get();
        if (!$user_event) {
            return redirect()->back()->with('error', 'Thông tin sự kiện không tồn tại.');
        }

        $data = [
            'event' => $event,
            'user' => $user,
            'today' => $today,
            'list_event_participation' => $list_event_participation,
            'user_event' => $user_event,
            'listCategory' => $listCategory,
        ];
        return view('event.edit', $data);
    }

    public function putEventUser(Request $request, $id)
    {
        $validateRules =$request->validate([
            'name' => 'required|min:6',
            'content' => 'required',
            'category_id' => 'required',
            'amount' => 'required|numeric',
            'time' => 'required|date|after:tomorrow',
            'address' => 'required',
        ]);
    
        $validator = Validator::make($request->all(), $validateRules);
        if ($request->has('image') && $request->file('image')) {
            $user_event = DB::table('event')->where('user_id', Auth::user())->orWhere('id', $id)->limit(1);
            $user_event->update([
                'name_event' => $request->name,
                'content' => $request->content,
                'user_id' => Auth::user()->id,
                'amount' => $request->amount,
                'time' => $request->time,
                'category_id' => $request->category_id,
                'address' => $request->address,
                'member' => 0,
                'image' => $request->image
            ]);
            return redirect()->route('/home/profile')->with('success', 'Cập nhật sự kiện thành công.');
        } else {
            $user_event = DB::table('event')->where('user_id', Auth::user())->orWhere('id', $id)->limit(1);
            $user_event->update([
                'name_event' => $request->name,
                'content' => $request->content,
                'user_id' => Auth::user()->id,
                'amount' => $request->amount,
                'time' => $request->time,
                'category_id' => $request->category_id,
                'address' => $request->address,
                'member' => 0,
                // 'image' => $request->image
            ]);
            return redirect()->route('/home/profile')->with('success', 'Cập nhật sự kiện thành công.');
        }
    }
    public function getEventAttendance(Request $request)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $eventList = DB::table("event")->orderBy('time', 'DESC')->get();
        $data = ['eventList' => $eventList, 'today' => $today];

        if ($request->session()->has('auth')) {
            return view("admin/attendance/attendance", $data);
        } else {
            return redirect()->route('admin.login');
        }
    }
}
