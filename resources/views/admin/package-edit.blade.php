@extends('layouts.admin.app')
@section('sidebar')
    @parent
    @include('layouts.admin.sidebar')
@endsection
@section('content')
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
    @if (session('status'))
        <div class="toast bg-primary fixed-top" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000" style="left: auto; top: 55px; right: 10px;">
            <div class="toast-header">
                <span data-feather="alert-circle" class="text-success mr-2"></span>
                <strong class="mr-auto">Package</strong>
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
    @foreach($paquete as $paquetes)

        <div class="row">
            <div class="col-3">
                <div class="row">
                    <div class="col-12">
                        @if (empty($paquetes->imagen))
                            <p class="font-weight-bold text-secondary small pb-1 mb-2">Package Thumbnail Image <span class="badge badge-warning">300x300 PX</span></p>
                            <form method="post" action="{{route('admin_image_maps_store_path')}}" enctype="multipart/form-data"
                                  class="dropzone" id="dropzone2">
                                <input type="hidden" value="{{$paquetes->id}}" name="id_package_file">
                                @csrf
                            </form>
                        @endif
                    </div>
                    <div class="col-12 mb-4">
                        @if ($paquetes->imagen)
                            <p class="font-weight-bold text-secondary small pb-1 mb-2">Package Thumbnail Image <span class="badge badge-warning">300x300 PX</span></p>
                            <img src="{{$paquetes->imagen}}" alt="" class="img-thumbnail w-100 mb-2">
                            <form action="{{route('admin_image_delete_map_package_form_path')}}" method="post" class="text-center">
                                {{--@method('DELETE')--}}
                                @csrf
                                <input type="hidden" name="id_package" value="{{$paquetes->id}}">
                                <input type="hidden" name="filename" value="{{$paquetes->imagen}}">
                                <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                            </form>
                        @endif
                    </div>
                    @php $imagen_slider = 0; @endphp

                    @if ($paquetes->imagen_paquetes->count() > 0)
                    <div class="col-12">
                        <div class="row">
                            <div class="col">
                                <p class="font-weight-bold text-secondary small pb-1 mb-2">Image Slider <span class="badge badge-warning">300x300 PX</span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="bd-example">
                                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">

                                            @foreach($paquetes->imagen_paquetes as $imagen)
                                                @if ($imagen_slider == 0)
                                                    @php $item_carousel = "active";  @endphp
                                                @else
                                                    @php $item_carousel = "";  @endphp
                                                @endif


                                                    <div class="carousel-item {{$item_carousel}}">
                                                        <img src="{{$imagen->nombre}}" alt="" class="img-thumbnail w-100 mb-2">

                                                        <div class="carousel-caption d-none d-md-block">
                                                            <form action="{{route('admin_image_delete_package_form_path')}}" method="post" class="text-center">
                                                                {{--@method('DELETE')--}}
                                                                @csrf
                                                                <input type="hidden" name="id_package" value="{{$paquetes->id}}">
                                                                <input type="hidden" name="id_imagen_package" value="{{$imagen->id}}">
                                                                <input type="hidden" name="filename" value="{{$imagen->nombre}}">
                                                                <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @php $imagen_slider = $imagen->count(); @endphp
                                            @endforeach

                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endif
                </div>
                <div class="row">

                    <div class="col-12">
                        @if ($imagen_slider < 3)
                            <p class="font-weight-bold text-secondary small pb-1 mb-2">Image Slider <span class="badge badge-warning">300x300 PX</span></p>
                            <form method="post" action="{{route('admin_image_slider_store_path')}}" enctype="multipart/form-data"
                                  class="dropzone" id="dropzone">
                                <input type="hidden" value="{{$paquetes->id}}" name="id_package_file">
                                @csrf
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col">
                <form action="{{route('admin_package_update_path', $id)}}" method="post">
                    @csrf
                    <div class="row">

                        <div class="col-8">
                            <div class="">
                                <div class="">
                                    <div class="row">
                                        <div class="col">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold text-secondary small" for="codigo">Code</label>
                                                <input type="text" name="codigo" class="form-control font-weight-bold {{ $errors->has('codigo') ? 'is-invalid' : '' }}" id="codigo" placeholder="" value="{{$paquetes->codigo}}">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('codigo') }}
                                                </div>
                                            </div>
                                        </div>
                                        {{--                            <div class="col-2">--}}
                                        {{--                                <div class="form-group">--}}
                                        {{--                                    <label class="font-weight-bold text-secondary small" for="codigo_f">Code Fare</label>--}}
                                        {{--                                    <input type="text" name="codigo_f" class="form-control font-weight-bold {{ $errors->has('codigo_f') ? 'is-invalid' : '' }}" id="codigo_f" value="{{$paquetes->codigo_f}}">--}}
                                        {{--                                    <div class="invalid-feedback">--}}
                                        {{--                                        {{ $errors->first('codigo_f') }}--}}
                                        {{--                                    </div>--}}
                                        {{--                                </div>--}}
                                        {{--                            </div>--}}
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="font-weight-bold text-secondary small" for="titulo">Title Package</label>
                                                <input type="text" name="titulo" class="form-control font-weight-bold {{ $errors->has('titulo') ? 'is-invalid' : '' }}" id="titulo" value="{{$paquetes->titulo}}">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('titulo') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold text-secondary small" for="duracion">Duration</label>
                                                <input type="number" name="duracion" class="form-control font-weight-bold {{ $errors->has('duracion') ? 'is-invalid' : '' }}" id="duracion" onkeyup="duration(this.value)" value="{{$paquetes->duracion}}">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('duracion') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <textarea id="textarea-package" class="textarea-package" name="descripcion">{{$paquetes->descripcion}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="my-3" id="contenido">
                                        <h4>Itinerary</h4>
                                        <hr>
                                        @php $i = 1; @endphp
                                        @foreach($paquete_itinerario->sortBy('codigo') as $paquete_itinerary)
                                            <div class="row mb-3 align-items-center">
                                                <div class="col-auto text-center">
                                                    <h6 class="font-weight-bold m-0">Day {{$i}}
                                                        <span data-feather="arrow-right" class=""></span>
                                                    </h6>
                                                </div>
                                                <div class="col">
                                                    <select class="selectpicker" data-live-search="true" title="choose itinerary of day {{$i}}" data-width="100%" name="itinerary[]">
                                                        @foreach($itinerario_full as $itinerary_full)
                                                            @if ($paquete_itinerary->itinerarios->id == $itinerary_full->id)
                                                                @php $select = "selected"; @endphp
                                                            @else
                                                                @php $select = ""; @endphp
                                                            @endif
                                                            <option value="{{$itinerary_full->id}}-{{$paquete_itinerary->id}}" {{$select}}>{{ucwords(strtolower($itinerary_full->titulo))}}
                                                        @endforeach
                                                    </select>
                                                    {{--                                        <div class="p-2 small shadow-sm mt-2">--}}
                                                    {{--                                            <div class="swiper-container">--}}
                                                    {{--                                                <div class="swiper-wrapper">--}}
                                                    {{--                                                    <div class="swiper-slide" id="resumen_{{$paquete_itinerary->itinerarios->id}}">--}}
                                                    {{--                                                        @php echo $paquete_itinerary->itinerarios->resumen; @endphp--}}
                                                    {{--                                                    </div>--}}
                                                    {{--                                                </div>--}}
                                                    {{--                                                <!-- Add Scroll Bar -->--}}
                                                    {{--                                                <div class="swiper-scrollbar"></div>--}}
                                                    {{--                                            </div>--}}
                                                    {{--                                        </div>--}}
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#iti_{{$paquete_itinerary->id}}">
                                                        <span data-feather="book-open" class=""></span>
                                                    </button>
                                                    <div class="modal fade" id="iti_{{$paquete_itinerary->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-2">
                                                                    <h6 class="modal-title" id="exampleModalLabel">Short</h6>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div id="resumen_{{$paquete_itinerary->id}}">
                                                                        @php echo $paquete_itinerary->itinerarios->resumen; @endphp
                                                                    </div>
                                                                    <div id="descripcion_{{$paquete_itinerary->id}}">
                                                                        @php echo $paquete_itinerary->itinerarios->resumen; @endphp
                                                                    </div>
                                                                </div>
                                                                {{--                            <div class="modal-footer">--}}
                                                                {{--                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                                                                {{--                                <button type="button" class="btn btn-primary">Save changes</button>--}}
                                                                {{--                            </div>--}}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{--                <a href="" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="{{$itinerary->resumen}}">--}}
                                                    {{--                    <span data-feather="book-open" class=""></span>--}}
                                                    {{--                </a>--}}
                                                    {{--                <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">--}}
                                                    {{--                    @php echo $itinerary->resumen; @endphp--}}
                                                    {{--                </button>--}}
                                                    {{--                <a tabindex="0" class="popover-dismiss" role="button" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="@php echo $itinerary->resumen; @endphp">View</a>--}}
                                                </div>
                                            </div>
                                            @php $i++; @endphp
                                        @endforeach
                                    </div>

                                    <div class="row">
                                        <div class="col-12 my-3">
                                            <h4>Included</h4>
                                            <hr>
                                            <div class="form-group">
                                                <textarea id="textarea-package" class="textarea-package" name="txta_included">{{$paquetes->incluye}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 my-3">
                                            <h4>Not Included</h4>
                                            <hr>
                                            <div class="form-group">
                                                <textarea id="textarea-package" class="textarea-package" name="txta_not_included">{{$paquetes->noincluye}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12" my-3>
                                            <h4>Optionals</h4>
                                            <hr>
                                            <div class="form-group">
                                                <textarea id="textarea-package" class="textarea-package" name="txta_optional">{{$paquetes->opcional}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col">
                                            <h4>Price</h4>
                                            <hr>
                                            <div class="row text-center font-weight-bold text-g-dark mb-2">
                                                <div class="col">

                                                </div>
                                                <div class="col">
                                                    Single
                                                </div>
                                                <div class="col">
                                                    Double
                                                </div>
                                                {{--<div class="col">--}}
                                                {{--Matrimonial--}}
                                                {{--</div>--}}
                                                <div class="col">
                                                    Triple
                                                </div>
                                            </div>
                                            @foreach($precio_paquetes_2 as $precio_paquete_2)

                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <span data-feather="star"></span>
                                                        <span data-feather="star"></span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><small>$</small></span>
                                                            </div>
                                                            <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_2_s" value="{{$precio_paquete_2->precio_s}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><small>USD</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><small>$</small></span>
                                                            </div>
                                                            <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_2_d" value="{{$precio_paquete_2->precio_d}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><small>USD</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--<div class="col">--}}
                                                    {{--<div class="input-group input-group-sm">--}}
                                                    {{--<div class="input-group-prepend">--}}
                                                    {{--<span class="input-group-text"><small>$</small></span>--}}
                                                    {{--</div>--}}
                                                    {{--<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="txt_2_m">--}}
                                                    {{--<div class="input-group-append">--}}
                                                    {{--<span class="input-group-text"><small>USD</small></span>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    <div class="col">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><small>$</small></span>
                                                            </div>
                                                            <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_2_t" value="{{$precio_paquete_2->precio_t}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><small>USD</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach($precio_paquetes_3 as $precio_paquete_3)
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <span data-feather="star"></span>
                                                        <span data-feather="star"></span>
                                                        <span data-feather="star"></span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><small>$</small></span>
                                                            </div>
                                                            <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_3_s" value="{{$precio_paquete_3->precio_s}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><small>USD</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><small>$</small></span>
                                                            </div>
                                                            <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_3_d" value="{{$precio_paquete_3->precio_d}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><small>USD</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--<div class="col">--}}
                                                    {{--<div class="input-group input-group-sm">--}}
                                                    {{--<div class="input-group-prepend">--}}
                                                    {{--<span class="input-group-text"><small>$</small></span>--}}
                                                    {{--</div>--}}
                                                    {{--<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="txt_3_m">--}}
                                                    {{--<div class="input-group-append">--}}
                                                    {{--<span class="input-group-text"><small>USD</small></span>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    <div class="col">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><small>$</small></span>
                                                            </div>
                                                            <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_3_t" value="{{$precio_paquete_3->precio_t}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><small>USD</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach($precio_paquetes_4 as $precio_paquete_4)
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <span data-feather="star"></span>
                                                        <span data-feather="star"></span>
                                                        <span data-feather="star"></span>
                                                        <span data-feather="star"></span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><small>$</small></span>
                                                            </div>
                                                            <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_4_s" value="{{$precio_paquete_4->precio_s}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><small>USD</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><small>$</small></span>
                                                            </div>
                                                            <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_4_d" value="{{$precio_paquete_4->precio_d}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><small>USD</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--<div class="col">--}}
                                                    {{--<div class="input-group input-group-sm">--}}
                                                    {{--<div class="input-group-prepend">--}}
                                                    {{--<span class="input-group-text"><small>$</small></span>--}}
                                                    {{--</div>--}}
                                                    {{--<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="txt_4_m">--}}
                                                    {{--<div class="input-group-append">--}}
                                                    {{--<span class="input-group-text"><small>USD</small></span>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    <div class="col">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><small>$</small></span>
                                                            </div>
                                                            <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_4_t" value="{{$precio_paquete_4->precio_t}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><small>USD</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach($precio_paquetes_5 as $precio_paquete_5)
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <span data-feather="star"></span>
                                                        <span data-feather="star"></span>
                                                        <span data-feather="star"></span>
                                                        <span data-feather="star"></span>
                                                        <span data-feather="star"></span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><small>$</small></span>
                                                            </div>
                                                            <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_5_s" value="{{$precio_paquete_5->precio_s}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><small>USD</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><small>$</small></span>
                                                            </div>
                                                            <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_5_d" value="{{$precio_paquete_5->precio_d}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><small>USD</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--<div class="col">--}}
                                                    {{--<div class="input-group input-group-sm">--}}
                                                    {{--<div class="input-group-prepend">--}}
                                                    {{--<span class="input-group-text"><small>$</small></span>--}}
                                                    {{--</div>--}}
                                                    {{--<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="txt_5_m">--}}
                                                    {{--<div class="input-group-append">--}}
                                                    {{--<span class="input-group-text"><small>USD</small></span>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    <div class="col">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><small>$</small></span>
                                                            </div>
                                                            <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_5_t" value="{{$precio_paquete_5->precio_t}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><small>USD</small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col">
                                            {{--<div id="dropzone" class="dropzone">--}}
                                            {{--</div>--}}
                                            {{--<form action="" method="post" enctype="multipart/form-data" class="dropzone" id="dropzone">--}}
                                            {{--<input type="file" name="file" />--}}
                                            {{--</form>--}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6><span data-feather="activity"></span> Difficulty</h6>
                                    <hr>
                                    <div class="swiper-container swiper-right">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                @foreach($level as $levels)
                                                    @forelse  ($paquete_dificultad->where('iddificultad', $levels->id) as $paquete_dificultades)
                                                        <span class="custom-checkbox d-block pr-3 text-ellipsis">
                                                <input type="checkbox" id="level_{{$levels->id}}" name="level[]" value="{{$levels->id}}" checked>
                                                <label for="level_{{$levels->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($levels->nombre))}}">{{ucwords(strtolower($levels->nombre))}}</label>
                                            </span>
                                                    @empty
                                                        <span class="custom-checkbox d-block pr-3 text-ellipsis">
                                                <input type="checkbox" id="level_{{$levels->id}}" name="level[]" value="{{$levels->id}}">
                                                <label for="level_{{$levels->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($levels->nombre))}}">{{ucwords(strtolower($levels->nombre))}}</label>
                                            </span>
                                                    @endforelse
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="swiper-scrollbar"></div>
                                    </div>
                                </div>
                            </div>


                            <div class="card bg-light my-3">
                                <div class="card-body">
                                    <h6><span data-feather="folder"></span> Category</h6>
                                    <hr>
                                    <div class="swiper-container swiper-right">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                @foreach($category as $categoria)
                                                    @forelse  ($paquete_category->where('idcategoria', $categoria->id) as $paquete_categoria)
                                                        <span class="custom-checkbox d-block pr-3 text-ellipsis">
                                                <input type="checkbox" id="category_{{$categoria->id}}" name="category[]" value="{{$categoria->id}}" checked>
                                                <label for="category_{{$categoria->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($categoria->nombre))}}">{{ucwords(strtolower($categoria->nombre))}}</label>
                                            </span>
                                                    @empty
                                                        <span class="custom-checkbox d-block pr-3 text-ellipsis">
                                                <input type="checkbox" id="category_{{$categoria->id}}" name="category[]" value="{{$categoria->id}}" >
                                                <label for="category_{{$categoria->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($categoria->nombre))}}">{{ucwords(strtolower($categoria->nombre))}}</label>
                                            </span>
                                                    @endforelse
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="swiper-scrollbar"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="card bg-light my-3">
                                <div class="card-body">
                                    <h6><span data-feather="map-pin"></span> Destinations</h6>
                                    <hr>
                                    <div class="swiper-container swiper-right">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                @foreach($destinations as $destino)
                                                    @forelse  ($paquete_destino->where('iddestinos', $destino->id) as $paquete_destinos)
                                                        <span class="custom-checkbox d-block pr-3 text-ellipsis">
                                                <input type="checkbox" id="destino_{{$destino->id}}" name="destino[]" value="{{$destino->id}}" checked>
                                                <label for="destino_{{$destino->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($destino->nombre))}}">{{ucwords(strtolower($destino->nombre))}}</label>
                                            </span>
                                                    @empty
                                                        <span class="custom-checkbox d-block pr-3 text-ellipsis">
                                                <input type="checkbox" id="destino_{{$destino->id}}" name="destino[]" value="{{$destino->id}}" >
                                                <label for="destino_{{$destino->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($destino->nombre))}}">{{ucwords(strtolower($destino->nombre))}}</label>
                                            </span>
                                                    @endforelse
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="swiper-scrollbar"></div>
                                    </div>
                                </div>
                            </div>

                            {{--                <div class="card bg-light my-3 w-100">--}}
                            {{--                    <div class="card-body">--}}
                            {{--                        <h6><span data-feather="plus"></span> Included</h6>--}}
                            {{--                        <hr>--}}
                            {{--                        <div class="swiper-container swiper-right">--}}
                            {{--                            <div class="swiper-wrapper">--}}
                            {{--                                <div class="swiper-slide">--}}
                            {{--                                    @foreach($incluye as $included)--}}
                            {{--                                        @forelse  ($paquete_incluye->where('idincluye', $included->id) as $paquete_included)--}}
                            {{--                                            <span class="custom-checkbox d-block pr-3 text-ellipsis">--}}
                            {{--                                                <input type="checkbox" id="incluye_{{$included->id}}" name="incluye[]" value="{{$included->id}}" checked>--}}
                            {{--                                                <label for="incluye_{{$included->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($included->incluye))}}">{{ucwords(strtolower($included->incluye))}}</label>--}}
                            {{--                                            </span>--}}
                            {{--                                        @empty--}}
                            {{--                                            <span class="custom-checkbox d-block pr-3 text-ellipsis">--}}
                            {{--                                                <input type="checkbox" id="incluye_{{$included->id}}" name="incluye[]" value="{{$included->id}}" >--}}
                            {{--                                                <label for="incluye_{{$included->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($included->incluye))}}">{{ucwords(strtolower($included->incluye))}}</label>--}}
                            {{--                                            </span>--}}
                            {{--                                        @endforelse--}}
                            {{--                                    @endforeach--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="swiper-scrollbar"></div>--}}
                            {{--                        </div>--}}
                            {{--                    </div>--}}
                            {{--                </div>--}}

                            {{--                <div class="card bg-light my-3">--}}
                            {{--                    <div class="card-body">--}}
                            {{--                        <h6><span data-feather="minus"></span> Not Included</h6>--}}
                            {{--                        <hr>--}}
                            {{--                        <div class="swiper-container swiper-right">--}}
                            {{--                            <div class="swiper-wrapper">--}}
                            {{--                                <div class="swiper-slide">--}}
                            {{--                                    @foreach($noincluye as $noincluded)--}}
                            {{--                                        @forelse  ($paquete_no_incluye->where('idnoincluye', $noincluded->id) as $paquete_noincluded)--}}
                            {{--                                            <span class="custom-checkbox d-block pr-3 text-ellipsis">--}}
                            {{--                                                <input type="checkbox" id="no_incluye_{{$noincluded->id}}" name="no_incluye[]" value="{{$noincluded->id}}" checked>--}}
                            {{--                                                <label for="no_incluye_{{$noincluded->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($noincluded->noincluye))}}">{{ucwords(strtolower($noincluded->noincluye))}}</label>--}}
                            {{--                                            </span>--}}
                            {{--                                        @empty--}}
                            {{--                                            <span class="custom-checkbox d-block pr-3 text-ellipsis">--}}
                            {{--                                                <input type="checkbox" id="no_incluye_{{$noincluded->id}}" name="no_incluye[]" value="{{$noincluded->id}}" >--}}
                            {{--                                                <label for="no_incluye_{{$noincluded->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($noincluded->noincluye))}}">{{ucwords(strtolower($noincluded->noincluye))}}</label>--}}
                            {{--                                            </span>--}}
                            {{--                                        @endforelse--}}
                            {{--                                    @endforeach--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="swiper-scrollbar"></div>--}}
                            {{--                        </div>--}}
                            {{--                    </div>--}}
                            {{--                </div>--}}

                        </div>
                    </div>
                    <hr>
                    <div class="row my-5">
                        <div class="col text-center">
                            {{--<a href="" class="btn btn-primary font-weight-bold">Update Package</a>--}}
                            <button type="submit" class="btn btn-primary font-weight-bold">Update Package</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    @endforeach
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.toast').toast('show');
        });


        Dropzone.autoDiscover = false;
        jQuery(document).ready(function() {
            $("#dropzone").dropzone({

                maxFilesize: 12,
                maxFiles: 3,
                // renameFile: function(file) {
                //     var dt = new Date();
                //     var time = dt.getTime();
                //     return time+file.name;
                // },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file){
                    // alert(response);
                    var name = file.name;
                    // alert(name);
                    var dataString = $('#dropzone').serialize()+'&'+$.param({ 'name_file': name });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_image_slider_delete_path') }}",
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
            $("#dropzone2").dropzone({

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
                    var name = file.name;
                    // alert(name);
                    var dataString = $('#dropzone2').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_image_delete_path') }}",
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
    <script>
        tinymce.init({
            selector: 'textarea.textarea-package',
            height: 250,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ]
        });
        // $('.selectpicker').selectpicker();
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        var swiper = new Swiper('.swiper-container', {
            direction: 'vertical',
            slidesPerView: 'auto',
            freeMode: true,
            scrollbar: {
                el: '.swiper-scrollbar',
            },
            mousewheel: true,
        });

        $('select').on('change', function () {
            // var duration = $('#duration_slc').val();
            var $id_itinerary = this.value;
            // alert($id_itinerary);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax( {
                type: "POST",
                url: "{{route('admin_package_duration_path')}}",
                data: {id_itinerary: $id_itinerary},
                success: function( response ) {
                    // console.log( $id );
                    $("#resumen_"+response.id).html(response.resumen);
                    $("#descripcion_"+response.id).html(response.descripcion);
                }
            } );
        });

        $("#contenido").load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");
        });

        function duration($duration){
            if ($duration){
                var $duration1 = $duration;
                $("#contenido").load("http://new-goto.nu/admin/package/load/"+49+"/"+$duration1+"");
            }
        }

    </script>
@endpush
