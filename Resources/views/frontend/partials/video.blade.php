@if(isset($performer->options->videos)&& !empty($performer->options->videos))
<div class="gallery-video mb-4">
    <p class="text-primary sub-title">Video</p>
    <div class="owl-carousel owl-theme">
        <div class="item">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{youtubeID($performer->options->videos) ??''}}" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
@endif

@section('scripts')
    <script>
        $(document).ready(function () {
            var owl = $('.gallery-video .owl-carousel');

            owl.owlCarousel({
                margin: 20,
                nav: true,
                loop: true,
                dots: false,
                lazyContent: true,
                autoplay: true,
                autoplayHoverPause: true,
                navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    640: {
                        items: 1
                    },
                    992: {
                        items: 1
                    }
                }
            });

        });
    </script>

    @parent

@stop
