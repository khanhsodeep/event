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
                    <a href="/admin/event/add" class="btn btn-outline-success m-2">
                        Thêm Sự kiện
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Tên</th>
                                <!-- <th class="text-center">Nội dung</th> -->
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Danh mục</th>
                                <th class="text-center">Hình ảnh</th>
                                <th class="text-center">Số vé</th>
                                <th class="text-center">Số người tham gia</th>
                                <th class="text-center">Số vé còn lại</th>
                                <th class="text-center">Thời gian</th>
                                <th class="text-center">Địa điểm</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                            <tr>
                                <td>{{$event->name_event}}</td>
                                <!-- <td>{{strip_tags($event->content)}}</td> -->
                                <td>
                                    @if($event->status == 0)
                                        <?php echo 'Đóng' ?>
                                    @elseif($event->status == 1)
                                    <?php echo 'Mở' ?>
                                    @endif
                                </td>
                                <!-- <td>{{$event->category}}</td> -->
                                <td>{{ !empty($event->category) ? $event->category->name:'' }}</td>
                                <td><img src="{{ asset('file/' . $event->image) }}" style="height: 50px; width: 50px;"></td>
                                <td>{{$event->amount}}</td>
                                <td>{{$event->member}}</td>
                                <td>{{$event->amount -$event->member}}</td> 
                                <td>{{$event->time}}</td>
                                <td>{{$event->address}}</td>
                                <td class="project-actions text-center">
                                    <a href="{{route('admin.event.edit', ['id' => $event->id])}}" class="btn btn-info btn-sm">
                                        <i class="fas fa-pencil-alt"> </i>
                                        Sửa
                                    </a>
                                    <a href="{{route('admin.event.delete', ['id' => $event->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn xóa Sự kiện này')">
                                        <i class="fas fa-trash"> </i>
                                        Xóa
                                    </a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">Tên</th>
                                <!-- <th class="text-center">Nội dung</th> -->
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Danh mục</th>
                                <th class="text-center">Hình ảnh</th>
                                <th class="text-center">Số vé</th>
                                <th class="text-center">Số người tham gia</th>
                                <th class="text-center">Số vé còn lại</th>
                                <th class="text-center">Thời gian</th>
                                <th class="text-center">Địa điểm</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </tfoot>
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
