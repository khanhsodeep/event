@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>

<head>
    <title>Vui lòng kiểm tra vé</title>
</head>
<body>
    <div class="visible-print text-center" style="margin-top:130px">
        @if (Auth::check())
        <h1>{{$ticket->name_event}}</h1>
        {!! QrCode::size(250)->email($ticket_user->email,$ticket_user->code)!!}
        <br>
        <br>
        <p>Kiểm tra và check-in vé</p>
        @endif
        
    </div>
</body>

</html>