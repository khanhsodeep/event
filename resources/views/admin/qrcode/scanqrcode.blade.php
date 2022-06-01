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
<script src="{{ asset('assets/js/instascan.min.js') }}"></script>
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
<script type="text/javascript">
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function(e) {
        console.error(e);
    });
    scanner.addListener('scan', function(qrCodeMessage) {
        index1 = qrCodeMessage.indexOf(':') + 1;
        index2 = qrCodeMessage.indexOf('?')
        code = qrCodeMessage.slice(-10)
        email = qrCodeMessage.slice(index1, index2)
        document.getElementById('result').innerHTML = '<span class="result">' + code + '<p>Email người tham dự:</p>' + email + '</span>';
        document.getElementById('text').value = code;
        document.forms[code].submit();
        document.getElementById('submit').click();

    })
</script>
@endpush
@section('page-title')
Điểm danh
@endsection

@section('content')
@include('admin/components/notify')


<!-- exm -->
<h1 style="text-align:center">{{$ticket->name_event}}</h1>

<div class="flex-container" style="text-align:center;">
    <video id="preview" style="width:50%; height:auto;"></video>
    <div id="result" style="text-align:center">Result Here</div>
</div>

<form action="" method="post" class="form-horizontal" style="text-align:center">
    @csrf()
    <label>MÃ VÉ</label>
    <input type="text" name="text" id="text">
    <button id="submit" type="submit" class="btn btn-primary">Điểm danh</button>
</form>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>

                                <th class="text-center">Người tham dự</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance as $event)
                            <tr>


                                @if($event->status == 1)

                                <td>{{$event->fullname}}</td>
                                <td>{{$event->email}}</td>
                                <td>{{$event->code}}</td>
                                @endif

                            </tr>

                            
                            @endforeach
                            <a href="{{route('admin.attendance.export-excel', ['id' => $ticket->event_id])}}" class="btn btn-outline-success m-2">
                                Download Excel
                            </a>
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