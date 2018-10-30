<meta name="description" content="{!! $performer->metadescription !!}">

<!-- Schema.org para Google+ -->
<meta itemprop="name" content="{{$performer->metatilte}}">
<meta itemprop="description" content="{{ $performer->metadescription }}">
<meta itemprop="image" content=" {{url($performer->options->mainimage ?? '') }}">

<!-- Open Graph para Facebook-->
<meta property="og:title" content="{{$performer->metatilte}}"/>
<meta property="og:type" content="articulo"/>
<meta property="og:url" content="{{url($performer->slug)}}"/>
<meta property="og:image" content="{{url($performer->options->mainimage ?? '')}}"/>
<meta property="og:description" content="{!! $performer->metadescription !!}"/>
<meta property="og:site_name" content="{{ Setting::get('core::site-name') }}"/>
<meta property="og:locale" content="{{locale().'_CO'}}">

<!-- Twitter Card -->
<meta name="twitter:card" content="metadescription_large_image">
<meta name="twitter:site" content="{{ Setting::get('core::site-name') }}">
<meta name="twitter:title" content="{{$performer->metatilte}}">
<meta name="twitter:description" content="{{$performer->metadescription }}">
<meta name="twitter:creator" content="">
<meta name="twitter:image:src" content="{{url($performer->options->mainimage ?? '')}}">