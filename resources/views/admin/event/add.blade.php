@extends('layouts.admin.master')

@push('style')
<!-- dropzonejs -->
<link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/min/dropzone.min.css') }}">
<link href="/css/profile.css" rel="stylesheet" type="text/css" />
<link href="/css/profile2.css" rel="stylesheet" type="text/css" />
<script src="/js/profile.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<section id="buy-tickets" class="section-with-bg">
    <style>
        a {text-decoration: none;}
    </style>
    @endpush

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

    @section('page-title')
    Thêm Sự kiện
    @endsection

    @section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm Sự kiện</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Tên sự kiện</label>
                        <input type="text" min="6" id="name" name="name" class="form-control" value="{{ old('name') }}">
                        @if($errors->first('name'))
                        <div class="text-danger text-bold">{{($errors->first('name'))}}</div>
                        @endif
                    </div>
                    <div class="form-group col-6">
                        <label for="cayegory_id">Danh mục</label>
                        <select id="category_id" class="form-control custom-select" name="category_id" required value="{{ old('category_id') }}">
                            <option selected="" disabled="">Danh mục</option>
                            @foreach ($categoryList as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('category_id'))
                        <div class="text-danger text-bold">{{($errors->first('category_id'))}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="status">Trạng thái</label>
                        <select id="status" class="form-control custom-select" name="status" required>
                            <option selected="" disabled="">Trạng thái</option>
                            <option value="0" selected>Đóng</option>
                            <option value="1">Mở</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="phone">Số vé</label>
                        <input type="number" id="amount" name="amount" class="form-control" min="1" required value="{{ old('amount') }}">
                        @if($errors->first('amount'))
                        <div class="text-danger text-bold">{{($errors->first('amount'))}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="form-group col-6">
                        <label for="phone">Nội dung</label>
                        <textarea class="ckeditor form-control" name="content"></textarea>
                    </div> -->
                    <div class="form-group col-6">
                        <label for="phone">Hình ảnh</label>
                        <input class="form-control" type="file" id="formFile" name="image" required value="{{ old('image') }}">
                        @if($errors->first('image'))
                        <div class="text-danger text-bold">{{($errors->first('image'))}}</div>
                        @endif
                    </div>
                    <div class="form-group col-3">
                        <label for="phone">Thời gian</label>
                        <input type="datetime-local" id="time" name="time" class="form-control" required value="{{ old('time') }}">
                        @if($errors->first('time'))
                        <div class="text-danger text-bold">{{($errors->first('time'))}}</div>
                        @endif
                    </div>
                    <div class="form-group col-3">
                        <label for="address">Địa điểm</label>
                        <input type="text" id="address" name="address" min="6" class="form-control" required value="{{ old('address') }}">
                        @if($errors->first('address'))
                        <div class="text-danger text-bold">{{($errors->first('address'))}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="phone">Nội dung</label>
                        <textarea class="ckeditor form-control" min="6" name="content" required value="{{ old('content') }}"></textarea>
                        @if($errors->first('content'))
                        <div class="text-danger text-bold">{{($errors->first('content'))}}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- <button type="reset" class="btn btn-secondary mr-2">Hủy</button> -->
                        <input type="submit" value="Thêm" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection