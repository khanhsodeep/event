@extends('layouts.admin.master')

@push('style')
<!-- dropzonejs -->
<link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/min/dropzone.min.css') }}">
<link href="/css/profile.css" rel="stylesheet" type="text/css" />
<link href="/css/profile2.css" rel="stylesheet" type="text/css" />
<script src="/js/profile.js"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<section id="buy-tickets" class="section-with-bg">
    <style>
        a {
            text-decoration: none;
        }
    </style>
    @endpush

    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
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

    @section('page-title')
    S???a S??? ki???n
    @endsection

    @section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">S???a S??? ki???n</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="" enctype="multipart/form-data" method="POST">
                @method('PUT')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">T??n s??? ki???n</label>
                        <input type="text" id="name" name="name" min="6" class="form-control" value="{{$event->name_event}}">
                        @if($errors->first('name'))
                        <div class="text-danger text-bold">{{($errors->first('name'))}}</div>
                        @endif
                    </div>
                    <div class="form-group col-6">
                        <label for="cayegory_id">Danh m???c</label>
                        <select id="category_id" class="form-control custom-select" name="category_id" required>
                            <option selected="" disabled="">Danh m???c</option>
                            @foreach ($listCategory as $category)
                            @if($category->id == $event->category_id)
                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        @if($errors->first('category_id'))
                        <div class="text-danger text-bold">{{($errors->first('category_id'))}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="status">Tr???ng th??i</label>
                        <select id="status" class="form-control custom-select" name="status">
                            <option selected="" disabled="">Tr???ng th??i</option>
                            <option value="0" {{ $event->status == 0 ? 'selected' : '' }}>????ng</option>
                            <option value="1" {{ $event->status == 1 ? 'selected' : '' }}>M???</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="phone">S??? v??</label>
                        <input min=1 type="number" id="amount" name="amount" class="form-control" value="{{$event->amount}}">
                        @if($errors->first('amount'))
                        <div class="text-danger text-bold">{{($errors->first('amount'))}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <!-- <label for="phone">N???i dung</label>
                        <textarea class="ckeditor form-control" name="content">{{$event->content}}</textarea> -->
                        <label for="phone">H??nh ???nh (B??? tr???ng n???u b???n kh??ng mu???n ?????i ???nh)</label>
                        <input class="form-control" type="file" id="formFile" name="image">
                        @if($errors->first('image'))
                        <div class="text-danger text-bold">{{($errors->first('image'))}}</div>
                        @endif
                    </div>
                    <div class="form-group col-3">
                        <label for="phone">Th???i gian</label>
                        <input type="datetime-local" id="time" name="time" class="form-control date" value="{{ date('Y-m-d\TH:i', strtotime($event->time)) }}" required>
                        @if($errors->first('time'))
                        <div class="text-danger text-bold">{{($errors->first('time'))}}</div>
                        @endif
                    </div>
                    <div class="form-group col-3">
                        <label for="address">?????a ??i???m</label>
                        <input type="text" id="address" name="address" class="form-control" min="6" value="{{$event->address}}" required>
                        @if($errors->first('address'))
                        <div class="text-danger text-bold">{{($errors->first('address'))}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="phone">N???i dung</label>
                        <textarea class="ckeditor form-control" min="6" name="content" required>{{$event->content}}</textarea>
                        @if($errors->first('content'))
                        <div class="text-danger text-bold">{{($errors->first('content'))}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- <button type="reset" class="btn btn-secondary mr-2">H???y</button> -->
                        <input type="submit" value="C???p nh???t" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection