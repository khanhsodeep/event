<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\AttendanceExport;




class QrCodeGeneratorController extends Controller
{
    public function getTicket($id)
    {
        $ticket = DB::table('ticket')->join('event', 'event.id', '=', 'ticket.event_id')->where('ticket.id', $id)->first();
        $ticket_user = DB::table('ticket')->join('users', 'ticket.user_id', '=', 'users.id')->where('ticket.id', $id)->where('users.id', Auth::user()->id)->first();
        $data = [
            'ticket' => $ticket,
            'ticket_user' => $ticket_user
        ];
        if ($ticket_user) {
            return view('users.qrCode', $data);
        } else {
            return redirect()->route('home')->with('warning', 'Mã không hợp lệ.');
        }
    }

    public function getscanqrcode(Request $request, $id)
    {


        $ticket = DB::table('ticket')->join('event', 'event.id', '=', 'ticket.event_id')->where('event.id', $id)->first();
        $attendance = (DB::table('ticket')->select('name_event', 'fullname', 'ticket.status', 'email', 'code', 'event_id')->join('event', 'event.id', '=', 'ticket.event_id')->where('event_id', $id))->join('users', 'users.id', 'ticket.user_id')->get();
        $data = [
            'ticket' => $ticket,
            'attendance' => $attendance,

        ];
        if ($request->session()->has('auth')) {
            if (!$ticket) {
                return redirect()->route('admin.attendance.attendance')->with('warning', 'Mã không hợp lệ.');
            } else {
                return view('admin.qrcode.scanqrcode', $data);
            }
        } else {
            return redirect()->route('admin.login');
        }
    }
    public function postscanqrcode(Request $request, $id)
    {
        $validateRules = [
            'text' => 'required|min:10|max:10',
        ];

        $ticket = DB::table('ticket')->where('event_id', $id)->get();
        $validator = Validator::make($request->all(), $validateRules);
        if ($validator->fails()) {
            return redirect()->route('admin.attendance', ['id' => $id])->with('warning', 'Mã không hợp lệ   .');
        }
        if (empty($ticket)) {
            return redirect()->route('admin.attendance', ['id' => $id])->with('warning', 'Hình sự bạn nhầm lẫn sự kiện.');
        }
        if (!empty($ticket)) {
            foreach ($ticket as $tk) {

                if ($request->text === $tk->code && $tk->status == 0) {
                    DB::table('ticket')
                        ->where('event_id', $id)->where('code', $request->text)
                        ->update([
                            'status' => DB::raw('1'),
                        ]);
                    return redirect()->route('admin.attendance', ['id' => $id])->with('success', 'Điểm danh sự kiện thành công.');
                }
                if ($request->text === $tk->code && $tk->status == 1) {
                    return redirect()->route('admin.attendance', ['id' => $id])->with('warning', 'Bạn đã điểm danh.');
                }
                if ($request->text != $tk->code) {
                    alert()->error('LỖI MÃ', 'Mã vé không phù hợp với sự kiện!');
                }
            }
            return redirect()->route('admin.attendance', ['id' => $id]);
        }
    }

    public function exportExcel($id)
    {

        $attendance = (DB::table('ticket')->select('name_event', 'fullname', 'ticket.status', 'email', 'code', 'event_id')->join('event', 'event.id', '=', 'ticket.event_id')->where('ticket.status', 1)->where('event.id', $id))->join('users', 'users.id', 'ticket.user_id')->first();
        if ($attendance) {
            $export = Excel::download(new AttendanceExport($id),  'diemdanhsukien_' . $attendance->event_id . '.xlsx');
            return $export;
        } else {
            return redirect()->route('admin.attendance.attendance')->with('warning', 'Danh sách điểm danh trống.');
        }
    }
}
