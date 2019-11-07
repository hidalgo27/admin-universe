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
                <strong class="mr-auto">Destination</strong>
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
    @if (session('delete'))
        <div class="toast bg-danger fixed-top" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000" style="left: auto; top: 55px; right: 10px;">
            <div class="toast-header">
                <span data-feather="alert-circle" class="text-success mr-2"></span>
                <strong class="mr-auto">Destination</strong>
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
                {{ session('delete') }}
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
                                <li class="breadcrumb-item active" aria-current="page">Destinations Edit</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="row">
        @foreach($destinations as $destination)

            <div class="col-3">
                <div class="row">
                    <div class="col-12 text-center">
                        @if ($destination->imagen)
                            <p class="font-weight-bold text-secondary small pb-1 mb-2">Destinations Thumbnail Image <span class="badge badge-warning">300x300 PX</span></p>
                            <img src="{{$destination->imagen}}" alt="" class="img-thumbnail w-100 mb-2">
                            <form action="{{route('admin_destinations_image_form_delete_path')}}" method="post">
                                @csrf
                                <input type="hidden" name="id_destino" value="{{$destination->id}}">
                                <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-4">
                        @if ($destination->imagen ==NULL)
                            <p class="font-weight-bold text-secondary small pb-1 mb-2">Destinations Thumbnail Image <span class="badge badge-warning">300x300 PX</span></p>
                            <form method="post" action="{{route('admin_image_destinations_image_store_path')}}" enctype="multipart/form-data"
                                  class="dropzone" id="dropzone_imagen">
                                <input type="hidden" value="{{$destination->id}}" name="id_destinations_file">
                                @csrf
                            </form>
                        @endif
                    </div>
                    @if ($destination->destino_imagen->count() > 0)
                    <div class="col-12 mb-4">
                        <p class="font-weight-bold text-secondary small pb-1 mb-2">Slider Destinations Images</p>
                        <div class="row">
                            <div class="col">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner text-center">
                                        @php $imagen_slider = 0; @endphp
                                        @foreach($destination->destino_imagen as $imagen)
                                            @if ($imagen_slider == 0)
                                                @php $item_carousel = "active";  @endphp
                                            @else
                                                @php $item_carousel = "";  @endphp
                                            @endif
                                            <div class="carousel-item {{$item_carousel}}">
                                                <img src="{{$imagen->nombre}}" alt="" class="img-thumbnail w-100 mb-2">
                                                <form action="{{route('admin_destinations_slider_form_delete_path')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_destinos" value="{{$destination->id}}">
                                                    <input type="hidden" name="id_destinos_imagen" value="{{$imagen->id}}">
                                                    <input type="hidden" name="filename" value="{{$imagen->nombre}}">
                                                    <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                                                </form>
                                            </div>
                                                @php $imagen_slider++; @endphp
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-12">
                        <p class="font-weight-bold text-secondary small pb-1 mb-2">Slider Destinations Images <span class="badge badge-warning">300x300 PX</span></p>
                        <form method="post" action="{{route('admin_image_destinations_slider_store_path')}}" enctype="multipart/form-data"
                              class="dropzone" id="dropzone_destinations">
                            <input type="hidden" value="{{$destination->id}}" name="id_destinations_file">
                            @csrf
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-9">
                <form action="{{route('admin_destinations_update_path', $destination->id)}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-bold text-secondary small" for="txt_destination">Destination</label>
                                <input type="text" name="txt_destination" class="form-control font-weight-bold" id="txt_destination" placeholder="" value="{{$destination->nombre}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-bold text-secondary small" for="txt_country">Country</label>
                                <input type="text" name="txt_country" class="form-control font-weight-bold" id="txt_country" value="{{$destination->pais}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Short</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_short">{{$destination->resumen}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Extended</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_extended">{{$destination->descripcion}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">History</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_history">{{$destination->historia}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Geography</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_geography">{{$destination->geografia}}</textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
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
            $("#dropzone_destinations").dropzone({

                maxFilesize: 12,
                maxFiles: 3,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file){
                    var name = file.name;
                    var dataString = $('#dropzone_destinations').serialize()+'&'+$.param({ 'name_file': name });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_destinations_slider_delete_path') }}",
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
            $("#dropzone_imagen").dropzone({

                maxFilesize: 12,
                maxFiles: 1,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file){
                    // var name = file.name;
                    var dataString = $('#dropzone_imagen').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_destinations_image_delete_path') }}",
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
@endpush
