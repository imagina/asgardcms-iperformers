@extends('layouts.master')

@section('meta')
@include('iperformers::frontend.metadatashow')
@stop

@section('title')
    {{ $performer->title }} | @parent
@stop

@section('content')
    <div class="layout-artists">
        <div class="contacto">
            <a href="">
                <img class="img-fluid" src="{{ Theme::url('img/whatsapp.png') }}">
            </a>
        </div>
        <div class=" pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-auto ml-auto">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent my-5">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{ URL::to('/') }}">Inicio</a>
                                </li>
                                <li class="breadcrumb-item"><a class="text-primary"
                                                               href="{{url($performer->type->url)}}">{{$performer->type->title}}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{$performer->title}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-7 col-lg-8 pb-5">

                        <div class="show-artist">
                            <p class="type"><strong
                                        class="text-primary">Categoría:</strong> {{$performer->type->title}}</p>
                            <h1 class="mb-4"><strong class="text-primary">Nombre:</strong> {{$performer->title}}</h1>

                            <div class="img-artist mb-4">
                                <img class="img-fluid w-100" src="{{ $performer->mainimage }}"
                                     alt="Card image cap">
                            </div>

                            <div class="bg-light p-4 mb-4">
                                <p class="text-primary sub-title mb-1">Servicios que Ofrece:</p>
                                <p>
                                    @if(count($performer->sevices))
                                        @foreach($performer->sevices as $index=>$psevice)
                                            {{$psevice->title}} @if($index !==end($performer->sevices)),@endif
                                        @endforeach
                                    @endif
                                </p>
                                <div class="border px-2 py-4 text-center mx-4 mt-4 mb-3">
                                    <div class="row">
                                        <div class="col border-right">
                                            <p class="sub-title my-0 text-primary">Estilo</p>
                                            <p>{{$performer->stile??''}}</p>
                                        </div>
                                        <div class="col">
                                            <p class="sub-title my-0 text-primary">Tipo</p>
                                            <p>{{$performer->type->title??''}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-primary sub-title">Descripción:</p>
                            <div class="text-justify mb-4">
                                {!!$performer->description!!}
                            </div>

                            <!-- gallery image -->
                        @include('iperformers::frontend.partials.image')

                        <!-- gallery video -->
                            @include('iperformers::frontend.partials.video')

                            <div class="bg-light p-4 text-center">
                                <h2 class="mb-3">¿QUIÉRES CONTACTAR ESTE ARTISTA?</h2>
                                <a href="{{url('contacto')}}" class="btn btn-primary">Click Aquí </a>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-5 col-lg-4">
                        @include('iperformers::frontend.partials.filters')
                        <ul class="list-group ml-0 ml-lg-5 mb-5 list-featured">
                            <li class="list-group-item bg-dark text-white">Artistas Destacados</li>
                            <!-- owl vertical -->
                            @include('iperformers::frontend.partials.featured')
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop




