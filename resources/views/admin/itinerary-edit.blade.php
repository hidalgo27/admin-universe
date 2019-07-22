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
                <strong class="mr-auto">Itinerary</strong>
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
                                <li class="breadcrumb-item active" aria-current="page">All Packages</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @foreach($itinerary as $itinerario)
    <form action="{{route('admin_itinerary_update_path', $itinerario->id)}}" method="post">
        @csrf
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label class="font-weight-bold text-secondary small" for="txt_codigo">Code</label>
                    <input type="text" name="txt_codigo" class="form-control font-weight-bold" id="txt_codigo" placeholder="" value="{{$itinerario->codigo}}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="font-weight-bold text-secondary small" for="txt_title">Title Package</label>
                    <input type="text" name="txt_title" class="form-control font-weight-bold" id="txt_title" value="{{$itinerario->titulo}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h3 class="font-weight-bold text-secondary small">Short</h3>
                <div class="form-group">
                    <textarea class="textarea-package" name="txta_short">{{$itinerario->resumen}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3 class="font-weight-bold text-secondary small">Extended</h3>
                <div class="form-group">
                    <textarea class="textarea-package" name="txta_extended">{{$itinerario->descripcion}}</textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col text-center">
                {{--<a href="" class="btn btn-primary font-weight-bold">Update Package</a>--}}
                <button type="submit" class="btn btn-primary font-weight-bold">Create itinerary</button>
            </div>
        </div>
    </form>
    <div class="row my-5">
        @foreach($itinerario->itinerario_imagen as $imagen)
            <div class="col-2 text-center">
                <img src="{{asset('images/itinerario/'.$imagen->nombre.'')}}" alt="" class="img-thumbnail w-100 mb-2">
                <form action="{{route('admin_iitinerary_image_delete_form_path')}}" method="post">
                    {{--@method('DELETE')--}}
                    @csrf
                    <input type="hidden" name="id_itinerario" value="{{$itinerario->id}}">
                    <input type="hidden" name="filename" value="{{$imagen->nombre}}">
                    <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                </form>
            </div>
        @endforeach
    </div>
    <div class="row my-5">
        <div class="col">
            <form method="post" action="{{route('admin_itinerary_image_store_path')}}" enctype="multipart/form-data"
                  class="dropzone" id="dropzone">
                <input type="hidden" value="{{$itinerario->id}}" name="id_itinerary_file">
                @csrf
            </form>
        </div>
    </div>
    @endforeach
@endsection
@push('scripts')
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=m4amx6h3rsnmj9whskr1vn3m6mpv7bi6qwwscvtbam4h0uic "></script>
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

    <script>
        // Dropzone.autoDiscover = false;
        // jQuery(document).ready(function() {
        //     $("#dropzone").dropzone({
        //         url: "../../../../admin/package/upload_file",
        //         dictDefaultMessage: "Drop files here or<br>click to upload..."
        //     });
        // });
        {{--Dropzone.createThumbnailFromUrl(file, "{{asset('images/destinations/puno.jpg')}}", callback, crossOrigin);--}}
        Dropzone.options.dropzone =
            {
                {{--init: function() {--}}
                    {{--thisDropzone = this;--}}
                    {{--// var name = file.upload.filename;--}}
                    {{--<!-- 4 -->--}}
                    {{--$.get("{{route('admin_itinerary_list_path')}}", function(data) {--}}

                        {{--<!-- 5 -->--}}
                        {{--$.each(data.images, function(key,value){--}}

                            {{--var mockFile = { name: value.original, size: value.size };--}}
                            {{--thisDropzone.emit("addedfile", mockFile);--}}
                            {{--thisDropzone.emit("thumbnail", mockFile, "http://new-goto.nu/images/itinerario/"+value.original);--}}
                            {{--thisDropzone.emit("complete", mockFile);--}}
                            {{--var existingFileCount = 1; // The number of files already uploaded--}}
                            {{--thisDropzone.options.maxFiles = thisDropzone.options.maxFiles - existingFileCount;--}}

                        {{--});--}}

                    {{--});--}}
                {{--},--}}

                maxFilesize: 12,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file){
                var name = file.upload.filename;

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_iitinerary_mage_delete_path') }}",
                        data: {filename: name},
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

                success: function (file, response) {
                    console.log(response);
                },
                error: function (file, response) {
                    return false;
                },
            };
    </script>
@endpush