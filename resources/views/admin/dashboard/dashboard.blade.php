@extends('layouts.admin.master')

@push('style')
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}" />
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('script')
<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    // SweetAlert2
    const deleteAlert = () => {
        Swal.fire({
            title: "Bạn chắc chắn muốn xóa?",
            text: "Dữ liệu sẽ bị xóa sẽ không thể hoàn tác",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Thoát",
            confirmButtonText: "Tiếp tục xóa",
        }).then((result) => {
            // if (result.isConfirmed) {
            //     Swal.fire("Đã xóa!", "", "success");
            // }
            alert(result);
        });
    };

    const successAlert = () => {
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Chỉnh sửa của bạn đã được lưu",
            showConfirmButton: false,
            timer: 1500,
        });
    };

    // data table
    $(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength": 10,
            "language": {
                "decimal": "",
                "emptyTable": "Không có dữ liệu trong bảng",
                "infoEmpty ": "Hiển thị 0 đến 0 của 0 mục ",
                "infoFiltered": "(Được lọc từ tổng số _MAX_ mục)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Hiển thị _MENU_ mục",
                "loadingRecords": "Đang tải...",
                "processing": "Đang xử lý...",
                "zeroRecords": "Không tìm thấy dữ liệu",
                "paginate": {
                    "first": "Đầu",
                    "last": "Cuối",
                    "next": "Trước",
                    "previous": "Sau"
                },
                "info": "Đang hiển thị _START_ đến _END_ của _TOTAL_ mục",
                "search": "Tìm kiếm:",
            }
        });
    });
</script>
@endpush

@section('page-title')
Tổng quan
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
                                <td class="text-center"> <a target="_blank" href="{{ route('user.event.detail', ['id' => $v->id]) }}"> {{$v->name_event}}</a></td>
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

