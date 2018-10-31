<form id="filter" method="get" action="{{route('iplaces.place.index')}}">

    <ul class="list-group list-group-flush ml-0 ml-lg-5 mb-5">
        <li class="list-group-item d-flex justify-content-between align-items-center rounded active"
            data-toggle="collapse" href="#collapseS" role="button" aria-expanded="false"
            aria-controls="collapseS">
            Generos
            <span class="badge badge-pill"><i class="fa fa-chevron-down"></i></span>
        </li>
        <div class="collapse pt-2 show" id="collapseS">
            @if(count($genres))
                @foreach($genres as $genre)
                    <li class="list-group-item border-0 py-1" data-style="button">
                        {{-- <label>
                            <input type="checkbox" class="flat-blue jsInherit"
                                   name="genres[]"
                                   value="{{$genre->id}}"
                                   @isset($oldZone) @if(in_array($genre->id, $oldZone)) checked="checked" @endif @endisset> {{$genre->title}}
                        </label> --}}
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="genres[]"
                                   id="customCheckz{{$genre->id}}" value="{{$genre->id}}"
                                   @isset($oldZone) @if(in_array($genre->id, $oldZone)) checked="checked" @endif @endisset>
                            <label class="custom-control-label text-capitalize"
                                   for="customCheckz{{$genre->id}}">{{$genre->title}}</label>
                        </div>
                    </li>
            @endforeach
        @endif
        <!--<li class="list-group-item"><a href="">Vestibulum at eros</a></li>-->
        </div>
    </ul>

    @if(count($types))
        @foreach($types as $type)
            @if($type->parent_id==0)
                <ul class="list-group list-group-flush ml-0 ml-lg-5 mb-5">
                    <li class="list-group-item d-flex justify-content-between align-items-center rounded active"
                        data-toggle="collapse" href="#collapseG" role="button" aria-expanded="false"
                        aria-controls="collapseG">
                        {{$type->title}}
                        <span class="badge badge-pill"><i class="fa fa-chevron-down"></i></span>
                    </li>

                    <div class="collapse pt-3 show" id="collapseG">
                        @if(count($type->children))
                            @foreach($type->children as $children)
                            <li class="list-group-item border-0 py-1" data-style="button">
                                {{--<label>
                                    <input type="checkbox" class="hidden"
                                           name="types[]"
                                           value="{{$type->id}}"
                                           @isset($oldCat) @if(in_array($type->id, $oldCat)) checked="checked" @endif @endisset> {{$type->title}}
                                </label> --}}
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="types[]"
                                           id="customCheckc{{$children->id}}" value="{{$children->id}}"
                                           @isset($oldTyp) @if(in_array($children->id, $oldTyp)) checked="checked" @endif @endisset>
                                    <label class="custom-control-label text-capitalize"
                                           for="customCheckc{{$children->id}}">{{$children->title}}</label>
                                </div>
                            </li>
                            @endforeach
                        @endif
                    </div>
                </ul>
        @endif
    @endforeach
@endif


</form>

@section('scripts')
    @parent

    <script>
        $(document).ready(function () {
            $('input[type="checkbox"], input[type="radio"]').on('change', function () {
                $("#filter").submit();
            });
        });

    </script>

@stop