
@extends('layouts.app')
@section('content')
<section id="speakers" class="section-with-bg">
</section>
<section id="speakers">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Sự kiện {{$event[0]->name}}</h2>
            </div>

            <div class="row">
            @foreach($event1 as $v)
                <div class="col-lg-4 col-md-6">
                    <div class="speaker" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('file/' . $v->image) }}" alt="Speaker 1" class="img-fluid2" />
                        <div class="details">
                            <h3><a href="{{route('user.event.detail', ['id' => $v->id])}}">{{$v->name_event}}</a></h3>
                            <p>{{$v->time}}, {{$v->address}}</p>
                            <div class="social">
                            
                         
                                <a class="buy-tickets scrollto" href="{{route('user.event.detail', ['id' => $v->id])}}">Tham gia ngay</a>
                           
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    </section>

@endsection
