@if(isset($performer->gallery))
<div class="gallery-img mb-4">
    <div class="owl-carousel owl-theme">

            @foreach($performer->gallery as $index => $images)
                <div class="item">
                    <img class="img-fluid w-100" data-fancybox="gallery" src="{{ $image }}"
                         alt="{{$performer->title}}-{{$index}}">
                </div>
            @endforeach

    </div>
</div>
@endif

@section('scripts')
    <script>
        $(document).ready(function () {
            var owl = $('.gallery-img .owl-carousel');

            owl.owlCarousel({
                margin: 0,
                nav: true,
                loop: true,
                dots: true,
                lazyContent: true,
                autoplay: true,
                autoplayHoverPause: true,
                navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    640: {
                        items: 2
                    },
                    992: {
                        items: 3
                    }
                }
            });

        });
    </script>

    @parent

@stop
