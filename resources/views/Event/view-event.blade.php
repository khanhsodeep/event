@extends('layouts.app')
@push('style')
<style>
    p:not(:first-child):empty {
        display: none
    }

    p:not(:first-child)>br {
        display: none
    }
</style>
@endpush
@section('content')
<main id="main" class="main-page">
    <section id="speakers-details" class="wow fadeIn">
        <div class="container">
            @include('sweetalert::alert')
            <div class="section-header">
                <h2>Nội dung sự kiện</h2>
            </div>
            <form action="" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">

                    <div class="col-md-6">
                        <img src="{{ asset('file/' . $event->image) }}" alt="{{ $event->name_event }}" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <div class="details">
                            <h2>{{ $event->name_event }}</h2>
                            @if ($event->time < $today) <span>Đã hết hạn</span> <br>
                                @elseif (Auth::check())
                                <button style="margin-left:0px" class="buy-tickets buy-tickets-hover scrollto" href="{{route('user.event.detail', ['id' => $event->id])}}">Tham gia ngay</button>
                                <i class="mt-2">Số vé còn lại: {{$event->amount}} </i> -
                                <i class="mt-2">Thời hạn đăng ký: {{$event->time}} </i>

                                @endif
                                <p class="mt-2">{!! strip_tags(str_replace("&nbsp;"," ",$event->content)) !!}</p>



                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
@endsection