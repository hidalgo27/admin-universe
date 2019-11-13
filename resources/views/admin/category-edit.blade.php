@extends('layouts.admin.app')
@section('sidebar')
    @parent
    @include('layouts.admin.sidebar')
@endsection
@section('content')
    @if (session('status'))
        <div class="toast bg-primary fixed-top" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000" style="left: auto; top: 55px; right: 10px;">
            <div class="toast-header">
                <span data-feather="alert-circle" class="text-success mr-2"></span>
                <strong class="mr-auto">Category</strong>
                <small>
                    @php
                        date_default_timezone_set('America/Lima');
                        echo date ("l m Y");
                    @endphp
                </small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body font-weight-bold text-white">
                {{ session('status') }}
            </div>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb small font-weight-bold p-0 m-0 bg-white">
                                <li class="breadcrumb-item"><a href="#">1. Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Category Edit</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="row">
        @foreach($categoria as $categorias)
            <div class="col-3">
                <div class="row">


                    <div class="col-12">
                        @if ($categorias->imagen == NULL)
                            <p class="font-weight-bold text-secondary small pb-1 mb-2">Category Thumbnail Image <span class="badge badge-warning">300x300 PX</span></p>
                            <form method="post" action="{{route('admin_image_category_image_store_path')}}" enctype="multipart/form-data"
                                  class="dropzone" id="dropzone_category_2">
                                <input type="hidden" value="{{$categorias->id}}" name="id_category_file">
                                @csrf
                            </form>
                        @endif
                    </div>


                    <div class="col-12 text-center">
                        @if ($categorias->imagen)
                            <p class="font-weight-bold text-secondary small pb-1 mb-2">Category Thumbnail Image <span class="badge badge-warning">300x300 PX</span></p>
                            <img src="{{asset('images/category/'.$categorias->imagen.'')}}" alt="" class="img-thumbnail w-100 mb-2">
                            <form action="{{route('admin_category_image_form_delete_path')}}" method="post">
                                @csrf
                                <input type="hidden" name="id_category" value="{{$categorias->id}}">
                                <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="row my-4">

                    <div class="col-12">
                        @if ($categorias->imagen_banner)
                            <div class="row">
                                <p class="font-weight-bold text-secondary small pb-1 mb-2">Slider Destinations Images</p>
                                <div class="col-12 text-center">
                                    <img src="{{$categorias->imagen_banner}}" alt="" class="img-thumbnail w-100 mb-2">
                                    <form action="{{route('admin_category_slider_form_delete_path')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_category" value="{{$categorias->id}}">
                                        <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-12">
                        @if ($categorias->imagen_banner == NULL)
                            <p class="font-weight-bold text-secondary small pb-1 mb-2">Slider Destinations Images <span class="badge badge-warning">300x300 PX</span></p>
                            <form method="post" action="{{route('admin_image_category_slider_store_path')}}" enctype="multipart/form-data"
                                  class="dropzone" id="dropzone_category">
                                <input type="hidden" value="{{$categorias->id}}" name="id_category_file">
                                @csrf
                            </form>
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-9">
                <form action="{{route('admin_category_update_path', $categorias->id)}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-bold text-secondary small" for="txt_category">Name</label>
                                <input type="text" name="txt_category" class="form-control font-weight-bold" id="txt_category" placeholder="" value="{{$categorias->nombre}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Description</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_descripcion">{{$categorias->descripcion}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="slc_group" class="font-weight-bold text-secondary small">Select Group</label>
                                <select class="form-control" id="slc_group" name="slc_group">
                                    <option value="1" class="text-g-yellow font-weight-bold" @if ($categorias->grupo == 1) selected @endif>Yellow</option>
                                    <option value="2" class="text-g-green font-weight-bold" @if ($categorias->grupo == 2) selected @endif>Green</option>
                                    {{--<option value="3">Grey</option>--}}
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold text-secondary small" for="txt_destination">First Panel</label>
                                <input type="checkbox" data-toggle="toggle" data-size="xs" @if ($categorias->estado == 1) checked @endif name="chk_order" value="1">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-bold text-secondary small" for="txt_destination">First Block</label>
                                <input type="checkbox" data-toggle="toggle" data-size="xs" @if ($categorias->orden_block == 1) checked @endif name="chk_order_block" value="1">
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col text-center">
                            {{--<a href="" class="btn btn-primary font-weight-bold">Update Package</a>--}}
                            <button type="submit" class="btn btn-primary font-weight-bold">Update destination</button>
                        </div>
                    </div>

                </form>
            </div>

        @endforeach
    </div>
@endsection
@push('scripts')
    <script>
        Dropzone.autoDiscover = false;
        jQuery(document).ready(function() {
            $("#dropzone_category").dropzone({

                maxFilesize: 12,
                maxFiles: 1,
                // renameFile: function(file) {
                //     var dt = new Date();
                //     var time = dt.getTime();
                //     return time+file.name;
                // },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file){
                    var name = file.upload.filename;
                    var dataString = $('#dropzone_category').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_category_slider_delete_path') }}",
                        data: dataString,
                        success: function (data) {
                            console.log("File has been successfully removed!!");
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },

                // success: function (file, response) {
                //     console.log(response);
                // },
                // error: function (file, response) {
                //     return false;
                // },

            });
            $("#dropzone_category_2").dropzone({

                maxFilesize: 12,
                maxFiles: 1,
                // renameFile: function(file) {
                //     var dt = new Date();
                //     var time = dt.getTime();
                //     return time+file.name;
                // },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file){
                    var name = file.upload.filename;
                    var dataString = $('#dropzone_category_2').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_category_image_delete_path') }}",
                        data: dataString,
                        success: function (data) {
                            console.log("File has been successfully removed!!");
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },

                // success: function (file, response) {
                //     console.log(response);
                // },
                // error: function (file, response) {
                //     return false;
                // },

            });
        });
    </script>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=4im5y0hsu2i10v7je2aecag5d41lh7hc0oh1mpj0lgv8pmgj "></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.textarea-package',
            height: 250,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ]
        });
        $(document).ready(function(){
            $('.toast').toast('show');
        });
    </script>
@endpush
