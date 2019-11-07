
<div class="col">
    <h4>Itinerary</h4>
    <hr>
    @php $i = 1; @endphp
    @foreach($itinerario as $itinerary)
        <div class="row mb-3 align-items-center">
            <div class="col-auto text-center">
                <h6 class="font-weight-bold m-0">Day {{$i}}
                    <span data-feather="arrow-right" class=""></span>
                </h6>
            </div>
            <div class="col">
                <select class="selectpicker" data-live-search="true" title="choose itinerary of day {{$i}}" data-width="100%" name="itinerary[]">
                    @foreach($itinerario_full as $itinerary_full)
                            <option value="{{$itinerary_full->id}}-{{$itinerary->id}}">{{ucwords(strtolower($itinerary_full->titulo))}}
                    @endforeach
                </select>
{{--                <div class="p-2 small shadow-sm mt-2">--}}
{{--                    <div class="swiper-container">--}}
{{--                        <div class="swiper-wrapper">--}}
{{--                            <div class="swiper-slide" id="resumen_{{$itinerary->id}}">--}}
{{--                                @php echo $itinerary->resumen; @endphp--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Add Scroll Bar -->--}}
{{--                        <div class="swiper-scrollbar"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#iti_{{$itinerary->id}}">
                    <span data-feather="book-open" class=""></span>
                </button>
                <div class="modal fade" id="iti_{{$itinerary->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header py-2">
                                <h6 class="modal-title" id="exampleModalLabel">Short</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="resumen_{{$itinerary->id}}">
                                    @php echo $itinerary->resumen; @endphp
                                </div>
                                <div id="descripcion_{{$itinerary->id}}">
                                    @php echo $itinerary->descripcion; @endphp
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

    <script>
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
        var swiper = new Swiper('.swiper-container', {
            direction: 'vertical',
            slidesPerView: 'auto',
            freeMode: true,
            scrollbar: {
                el: '.swiper-scrollbar',
            },
            mousewheel: true,
        });
        $('select').selectpicker();
        feather.replace();

        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                html:true,
            })
        });

        $('.popover-dismiss').popover({
            trigger: 'focus',
            html:true,
        })
    </script>
</div>
