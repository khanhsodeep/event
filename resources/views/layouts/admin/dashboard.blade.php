<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('page-title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" />
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" />
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.cs') }}s" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}" />
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}" />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" />
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}" />
    <!-- other style -->
    @stack('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('/img/loading2.png') }}" alt=""  />
        </div>

        <!-- Navbar -->
        @include('admin/components/navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin/components/sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('page-title')</h1>
                            @section('page-title')
Quản lý Sự kiện
@endsection

@section('content')
<!-- /.card -->
@include('admin/components/notify')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="btn btn-outline-success m-2">
                        Thống kê sự kiện
                    <h1>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Tổng số sự kiện</th>
                                <!-- <th class="text-center">Nội dung</th> -->
                                <th class="text-center">Sự kiện nhiều người tham gia trong tuần</th>
                                <th class="text-center">Số lượng người tham gia sự kiện</th>
                                <th class="text-center">Người dùng tạo nhiều sự kiện nhất</th>
                                <th class="text-center">Tổng số sự kiện người dùng đã tạo</th>
                                <th class="text-center">Tổng số sự kiện đã duyệt</th>
                                <th class="text-center">Tổng số sự kiện chưa duyệt</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                         
                                @foreach ((array)$counts as $count)
                                <td class="text-center">{{$count}}</td>
                                @endforeach
                                @foreach ($event_favourites as $v)
                                <td class="text-center">  <a target="_blank" href="{{ route('user.event.detail', ['id' => $v->id]) }}"> {{$v->name_event}}</a></td>
                                @endforeach
                           
                                @foreach ($event_favourites as $v)
                                <td class="text-center">{{$v->member}}</td>
                                @endforeach
                                @foreach ($countuser_create as $count)
                                <td class="text-center"> {{$count->email}}</td>
                                @endforeach
                                @foreach ($countuser_create as $count)
                                <td class="text-center"> {{$count->total}}</td>
                                @endforeach
                                @foreach ($countstatus as $count)
                                <td class="text-center"> {{$count->total}}</td>
                                @endforeach
                                @foreach ($countstatus_non as $count)
                                <td class="text-center"> {{$count->total}}</td>
                                @endforeach

                                
                              
                            </tr>
                           
                        </tbody>
                        <!-- <tfoot>
                            <tr>
                            <th class="text-center">Tổng số sự kiện</th>
                                <th class="text-center">Nội dung</th>
                                <th class="text-center">Sự kiện nhiều người tham gia trong tuần</th>
                                <th class="text-center">Số lượng người tham gia sự kiện</th>
                                <th class="text-center">Người dùng tạo nhiều sự kiện nhất</th>
                                <th class="text-center">Số lượng đã tạo</th>
                                <th class="text-center">Số lượng bài viết đã duyệt</th>
                                <th class="text-center">Số lượng bài viết chưa duyệt</th>
                            </tr>
                        </tfoot> -->
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="btn btn-outline-success m-2">
                        Thống kê người dùng
                    <h1>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                            <th class="text-center">Tống số người dùng tham gia</th>
                                <!-- <th class="text-center">Nội dung</th> -->
                               
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                         
                                @foreach ((array)$countuser as $count)
                                <td class="text-center"> {{$count}}</td>
                                @endforeach
                              
                                
                              
                            
                              
                            </tr>
                           
                        </tbody>
                        <!-- <tfoot>
                            <tr>
                                <th class="text-center">Tống số người dùng tham gia</th>
                                <th class="text-center">Nội dung</th>
                             
                            </tr>
                        </tfoot> -->
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
@endsection

                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content pb-4">
                @yield('content')
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
    <!-- Other script -->
    @stack('script')
</body>

</html>
