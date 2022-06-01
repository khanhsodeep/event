<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\QrCodeGeneratorController;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Exportable;

class AttendanceExport implements FromCollection
{

    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct(int $id)
    {
        $this->id = $id;
    }


    public function collection()
    {

        $attendance = (DB::table('ticket')->select('name_event', 'fullname', 'ticket.status', 'email', 'code', 'event_id')->join('event', 'event.id', '=', 'ticket.event_id')->where('ticket.status', 1)->where('event.id', $this->id))->join('users', 'users.id', 'ticket.user_id')->get();
        return $attendance;
    }
}
