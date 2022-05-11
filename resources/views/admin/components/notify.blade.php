@if($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger">
    {!! $error !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endforeach
@endif
@if(Session::has('alert_success'))
<div class="alert alert-success">
    {!! Session::get('alert_success') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(Session::has('alert_error'))
<div class="alert alert-danger">
    {!! Session::get('alert_error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif