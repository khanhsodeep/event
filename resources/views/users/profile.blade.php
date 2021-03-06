@extends('layouts.app')
@push('script')

<!-- dropzonejs -->
<script src="{{ asset('assets/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script>
    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/target-url", // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })

    myDropzone.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function() {
            myDropzone.enqueueFile(file)
        }
    })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function(file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0"
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End
</script>
@endpush
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
    @include('sweetalert::alert')

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
                                    <p class="m-b-10">Ng??y tham gia: {{ Auth::user()->created_at}}</p>
                                    <button class="btn btn-sm btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">S???a th??ng tin</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Th??ng tin t??i kho???n</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <input class="form-control" type="text" placeholder="T??n" aria-label="default input example" name="fullname" value="{{$user->fullname}}">
                        <!-- <input class="form-control" type="password" placeholder="M???t kh???u" aria-label="default input example" name="password"> -->
                        @if($errors->first('fullname'))
                        <div class="text-danger text-bold" style="font-weight: bold;">{{($errors->first('fullname'))}}</div>
                        @endif
                    </div>
                    <div class="modal-body">
                        <!-- <input class="form-control" type="text" placeholder="T??n" aria-label="default input example" name="fullname"> -->
                        <input class="form-control" type="password" placeholder="????? tr???ng n???u b???n kh??ng mu???n thay ?????i m???t kh???u" aria-label="default input example" name="password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">????ng</button>
                        <button type="submit" class="btn btn-primary">C???p nh???t</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade event" id="exampleModalEvent" tabindex="-1" aria-labelledby="exampleModalLabelEvent" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Th??ng tin t??i kho???n</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <input class="form-control" type="text" placeholder="T??n" aria-label="default input example" name="fullname" value="{{$user->fullname}}">
                        @if($errors->first('fullname'))
                        <div class="text-danger text-bold" style="font-weight: bold;">{{($errors->first('fullname'))}}</div>
                        @endif
                    </div>
                    <div class="modal-body">
                        <!-- <input class="form-control" type="text" placeholder="T??n" aria-label="default input example" name="fullname"> -->
                        <input class="form-control" type="password" placeholder="????? tr???ng n???u b???n kh??ng mu???n thay ?????i m???t kh???u" aria-label="default input example" name="password">
                        @if($errors->first('password'))
                        <div class="text-danger text-bold" style="font-weight: bold;">{{($errors->first('password'))}}</div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">????ng</button>
                        <button type="submit" class="btn btn-primary">C???p nh???t</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="tabs">
            <input type="radio" name="tab" id="tab1" checked="checked">
            <label for="tab1">S??? KI???N ???? T???O</label>
            <input type="radio" name="tab" id="tab2">
            <label for="tab2">V?? M???I S??? KI???N</label>
            <input type="radio" name="tab" id="tab3">
            <label  for="tab3" ><a class="text-dark text-decoration-none" href="{{route('user.event.add')}}">T???O S??? KI???N M???I</a></label>

            <div class="tab-content-wrapper">
                <div id="tab-content-1" class="tab-content">
                    <div class="tab-pane fade show active" id="pills-company" role="tabpanel" aria-labelledby="pills-company-tab">

                        <div class="container-fluid">
                            <h2 class="mb-3 font-weight-bold text-center">Danh s??ch s??? ki???n ???? t???o</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">T??n s??? ki???n</th>
                                        <th scope="col">Ng??y t??? ch???c</th>
                                        <th scope="col">?????a ??i???m</th>
                                        <th scope="col">S??? v??</th>
                                        <th scope="col">Tr???ng th??i</th>
                                        <th scope="col">H??nh ?????ng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($event as $e)
                                    <tr>
                                        <td data-label="#">{{$e->id}}</td>
                                        <td data-label="T??n s??? ki???n" style="font-weight: bold;">{{$e->name_event}}</td>
                                        <td data-label="Ng??y t??? ch???c">{{$e->time}}</td>
                                        <td data-label="?????a ??i???m" style="font-weight: bold;">{{$e->address}}</td>
                                        <td data-label="S??? v??" style="font-weight: bold;">{{$e->amount}}</td>
                                        @if ($e->status == 1)
                                        <td data-label="Tr???ng th??i" class="text-success" style="font-weight: bold;">???? ???????c duy???t</td>
                                        @else
                                        <td data-label="Tr???ng th??i" class="text-danger" style="font-weight: bold;">Ch??a ???????c duy???t</td>
                                        @endif
                                        @if ($e->status == 0)
                                        <td data-label="H??nh ?????ng" class="project-actions text-center">
                                            <a href="{{route('client.event.edit', ['id' => $e->id])}}" class="btn btn-info btn-sm">
                                                <i class="fas fa-pencil-alt"> </i>
                                                S???a
                                            </a>
                                            <a href="{{route('client.event.delete', ['id' => $e->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('B???n c?? ch???c ch???n x??a S??? ki???n n??y')">
                                                <i class="fas fa-trash"> </i>
                                                X??a
                                            </a>

                                        </td>
                                        @else
                                        <td data-label="H??nh ?????ng" class="project-actions">
                                            <a class="btn btn-secondary btn-sm">
                                                <i class="bi bi-dash-circle"></i>
                                                Kh??ng th??? s???a
                                            </a>
                                        </td>

                                        @endif

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tab-content-2" class="tab-content">

                    <div class="container-fluid">
                        <h2 class="mb-3 font-weight-bold text-center">Danh s??ch v?? m???i</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">T??n s??? ki???n</th>
                                    <th scope="col">Ng??y t??? ch???c</th>
                                    <th scope="col">?????a ??i???m</th>
                                    <th scope="col">V??</th>
                                    <th class="project-actions text-center" scope="col">Tr???ng th??i</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list_event_participation as $value)
                                <tr>
                                    <td data-label="#">{{$value->id}}</td>
                                    <td data-label="T??n s??? ki???n" style="font-weight: bold;">{{$value->name_event}}</td>
                                    <td data-label="Ng??y t??? ch???c">{{$value->time}}</td>
                                    <td data-label="?????a ??i???m" style="font-weight: bold;">{{$value->address}}</td>
                                    <td data-label="V??"><a class="btn btn-success btn-sm" href="{{route('user.home.qr-code', ['id' => $value->id]) }}">{{$value->code}}</a> </td>

                                    @if($value->time>$today && $value->status == 0)
                                    <td data-label="Tr???ng th??i" class="project-actions">
                                        <a href="{{route('client.ticket.delete', ['id' => $value->id])}}" class="btn btn-danger btn-sm" onclick="return confirm('B???n c?? ch???c ch???n mu???n h???y tham gia')">
                                            <i class="fas fa-trash"> </i>
                                            Hu??? tham gia
                                        </a>
                                    </td>
                                    @elseif($value->status == 1)
                                    <td data-label="Tr???ng th??i" class="project-actions">
                                        <a class="btn btn-success btn-sm">
                                            <i class="bi bi-check-circle"></i>
                                            ???? tham gia
                                        </a>
                                    </td>
                                    @else
                                    <td data-label="Tr???ng th??i" class="project-actions">
                                        <a class="btn btn-secondary btn-sm">
                                            <i class="bi bi-dash-circle"></i>
                                            H???t th???i gian
                                        </a>
                                    </td>
                                    @endif


                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>

</section>
@endsection