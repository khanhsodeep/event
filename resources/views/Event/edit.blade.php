@extends('layouts.app')
@section('content')
<link href="/css/profile.css" rel="stylesheet" type="text/css" />
<link href="/css/profile2.css" rel="stylesheet" type="text/css" />
<script src="/js/profile.js"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<section id="buy-tickets" class="section-with-bg">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="content" class="content content-full-width">
                    <!-- begin profile -->
                    <div class="profile mt-5">
                        <div class="profile-header">
                            <!-- BEGIN profile-header-cover -->
                            <div class="profile-header-cover"></div>
                            <!-- END profile-header-cover -->
                            <!-- BEGIN profile-header-content -->
                            <div class="profile-header-content">
                                <!-- BEGIN profile-header-img -->
                                <div class="profile-header-img">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                </div>
                                <!-- END profile-header-img -->
                                <!-- BEGIN profile-header-info -->
                                <div class="profile-header-info">
                                    <h4 class="m-t-10 m-b-5">{{ Auth::user()->name }}</h4>
                                    <p class="m-b-6">Email: {{ Auth::user()->email }}</p>
                                    <p class="m-b-10">Ngày tham gia: {{ Auth::user()->created_at}}</p>
                                    <button class="btn btn-sm btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Sửa thông tin</button>
                                </div>
                                <!-- END profile-header-info -->
                            </div>
                            <!-- END profile-header-content -->
                            <!-- BEGIN profile-header-tab -->

                            <!-- END profile-header-tab -->
                        </div>
                    </div>
                    <!-- end profile -->
                    <!-- begin profile-content -->

                    <!-- end profile-content -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <input class="form-control" type="text" placeholder="Tên" aria-label="default input example" name="fullname" value="{{$user->fullname}}">
                        <!-- <input class="form-control" type="password" placeholder="Mật khẩu" aria-label="default input example" name="password"> -->
                    </div>
                    <div class="modal-body">
                        <!-- <input class="form-control" type="text" placeholder="Tên" aria-label="default input example" name="fullname"> -->
                        <input class="form-control" type="password" placeholder="Để trống nếu bạn không muốn thay đổi mật khẩu" aria-label="default input example" name="password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade event" id="exampleModalEvent" tabindex="-1" aria-labelledby="exampleModalLabelEvent" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <input class="form-control" type="text" placeholder="Tên" aria-label="default input example" name="fullname" value="{{$user->fullname}}">
                        <!-- <input class="form-control" type="password" placeholder="Mật khẩu" aria-label="default input example" name="password"> -->
                    </div>
                    <div class="modal-body">
                        <!-- <input class="form-control" type="text" placeholder="Tên" aria-label="default input example" name="fullname"> -->
                        <input class="form-control" type="password" placeholder="Để trống nếu bạn không muốn thay đổi mật khẩu" aria-label="default input example" name="password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="tabs-to-dropdown">
            <div class="nav-wrapper d-flex align-items-center justify-content-between">
                <ul class="nav nav-pills d-none d-md-flex" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-company-tab" data-toggle="pill" href="#pills-company" role="tab" aria-controls="pills-company" aria-selected="true">SỬA SỰ KIỆN</a>
                    </li>
                </ul>
            </div>
            <div class="" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-company" role="tabpanel" aria-labelledby="pills-company-tab">
                    <div class="profile-content">
                        <!-- begin  -->
                        <div class=" p-0">
                            <!-- begin #profile-post tab -->
                            <div class="tab-pane fade active show" id="profile-post">
                                <!-- begin timeline -->
                                <div class="container-fluid">
                                    <form method="post" action="" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">Tên sự kiện</label>
                                                <input type="text" id="name" name="name" class="form-control" required placeholder="Nhập tên sự kiện" value="{{$user_event->name_event}}">
                                                @if($errors->first('name'))
                                                <div class="text-danger text-bold" style="font-weight: bold;" style="font-weight: bold;">{{($errors->first('name'))}}</div>
                                                @endif
                                            </div>
                                            <div class="form-group col-6">
                                                <option selected="" disabled="">Danh mục</option>
                                                <select id="category_id" class="form-control custom-select" name="category_id">
                                                    @foreach ($listCategory as $category)
                                                    @if($category->id == $user_event->category_id)
                                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                                    @else
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @if($errors->first('category_id'))
                                                <div class="text-danger text-bold" style="font-weight: bold;">{{($errors->first('category_id'))}}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="phone">Số vé</label>
                                                <input type="number" min="1" id="amount" name="amount" class="form-control" required placeholder="Nhập số lượng vé" value="{{$user_event->amount}}">
                                                @if($errors->first('amount'))
                                                <div class="text-danger text-bold" style="font-weight: bold;">{{($errors->first('amount'))}}</div>
                                                @endif
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="phone">Hình ảnh (Để trống nếu bạn không muốn thay đổi ảnh)</label>
                                                <input class="form-control" type="file" id="formFile" name="image">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="phone">Thời gian</label>
                                                <input type="datetime-local" id="time" name="time" class="form-control" required value="{{ date('Y-m-d\TH:i', strtotime($user_event->time)) }}">
                                                @if($errors->first('time'))
                                                <div class="text-danger text-bold" style="font-weight: bold;">{{($errors->first('time'))}}</div>
                                                @endif
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="address">Địa điểm</label>
                                                <input type="text" id="address" name="address" class="form-control" required placeholder="Nhập địa điểm diễn ra sự kiện" value="{{$user_event->address}}">
                                                @if($errors->first('address'))
                                                <div class="text-danger text-bold" style="font-weight: bold;">{{($errors->first('address'))}}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="phone">Nội dung</label>
                                                <textarea class="ckeditor form-control" name="content" required>{{$user_event->content}}</textarea>
                                                @if($errors->first('content'))
                                                <div class="text-danger text-bold" style="font-weight: bold;">{{($errors->first('content'))}}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-12">
                                                <!-- <button type="reset" class="btn btn-secondary mr-2">Hủy</button> -->
                                                <input type="submit" value="Cập nhật" class="btn btn-success">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end timeline -->
                            </div>
                            <!-- end #profile-post tab -->
                        </div>
                        <!-- end  -->
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-product" role="tabpanel" aria-labelledby="pills-product-tab">
                    <div class="container-fluid">
                        <h2 class="mb-3 font-weight-bold">Danh sách vé mời</h2>
                        <!-- <p>Hiển thị dạng table: Các giá trị của cột: STT, Tên sự kiện, Ngày nhận vé, Vé (Là mã QR nhận được lúc ấn tham gia sự kiện)</p> -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên sự kiện</th>
                                    <th scope="col">Ngày tổ chức</th>
                                    <th scope="col">Địa điểm</th>
                                    <th scope="col">Vé</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list_event_participation as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->name_event}}</td>
                                    <td>{{$value->time}}</td>
                                    <td>{{$value->address}}</td>
                                    <td>{{$value->code}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- <div class="tab-pane fade" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab">
                    
                    <div class="container-fluid">
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Tiêu đề sự kiện</span>
                                </div>
                                <input type="text" class="form-control" aria-describedby="basic-addon1" name="name" required>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-7 offset-3 mt-4">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <textarea class="ckeditor form-control" name="content" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-danger">Tạo</button>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

</section>
@endsection