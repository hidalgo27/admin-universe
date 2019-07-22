
<div class="col">
    <h4>Itinerary</h4>
    <hr>
    @php $i = 1; @endphp
    @foreach($itinerario->sortBy('codigo') as $itinerary)
        <div class="row mb-3 align-items-center">
            <div class="col-auto text-center">
                <h6 class="font-weight-bold">Day {{$i}} <span data-feather="corner-down-right" class="d-block"></span></h6>
            </div>
            <div class="col">
                <select class="selectpicker" data-live-search="true" title="choose itinerary of day {{$i}}" data-width="100%" name="itinerary[]">
                    @foreach($itinerario_full as $itinerary_full)
                            <option value="{{$itinerary_full->id}}-{{$itinerary->id}}"><span class="font-weight-bold">{{$itinerary_full->codigo}}:</span> {{ucwords(strtolower($itinerary_full->titulo))}}
                    @endforeach
                </select>
                <div class="p-2 small shadow-sm mt-2">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" id="resumen_{{$itinerary->id}}">
                                @php echo $itinerary->resumen; @endphp
                            </div>
                        </div>
                        <!-- Add Scroll Bar -->
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
            </div>
        </div>
        @php $i++; @endphp
    @endforeach

    <script>
        $('select').on('change', function () {
            // var duration = $('#duration_slc').val();
            var $id_itinerary = this.value;
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
    </script>
</div>
