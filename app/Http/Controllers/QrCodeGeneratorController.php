<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class QrCodeGeneratorController extends Controller
{
    public function getTicket($id)
    {
        $ticket = DB::table('ticket')->join('event', 'event.id', '=', 'ticket.event_id')->where('ticket.id',$id)->first();
        $ticket_user = DB::table('ticket')->join('users', 'ticket.user_id', '=', 'users.id')->where('ticket.id',$id)->first();
        $data = [
            'ticket' =>$ticket,
            'ticket_user' =>$ticket_user
        ];
        return view('qrCode', $data);
}
}
