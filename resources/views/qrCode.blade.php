@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Vui lòng kiểm tra vé</title>
</head>
<body> 
<div class="visible-print text-center" style="margin-top:130px">
    <h1>{{$ticket->name_event}}</h1>
    {!! QrCode::size(250)->generate($ticket_user->email);!!} 
    <br>
    <br>
    <p>Kiểm tra và check-in vé</p>
</div> 
</body>
</html>