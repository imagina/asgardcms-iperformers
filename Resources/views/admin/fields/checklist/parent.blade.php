<div class="row checkbox">

    <div class="col-xs-12">
        <div class="content-cat" style="max-height:490px;overflow-y: auto;">

            <label for="types"><strong>{{trans('iperformers::performers.table.types')}}</strong></label>


            @if(count($types)>0)
                @php
                    if(isset($performer->types) && count($performer->types)>0){
                    $oldCat = array();
                        foreach ($performer->types as $cat){
                                   array_push($oldCat,$cat->id);
                               }

                           }else{
                           $oldCat=old('types');
                           }
                @endphp

                <ul class="checkbox" style="list-style: none;padding-left: 5px;">

                    @foreach ($types as $type)
                        @if($type->parent_id==0)
                            <li  style="padding-top: 5px">
                                <label>
                                    <input type="checkbox" class="flat-blue jsInherit" name="types[]"

                                           value="{{$type->id}}"
                                           @isset($oldCat) @if(in_array($type->id, $oldCat)) checked="checked" @endif @endisset> {{$type->title}}
                                </label>
                                @if(count($type->children)>0)
                                    @php
                                        $children=$type->children
                                    @endphp
                                    @include('iperformers::admin.fields.checklist.children',['children'=>$children])
                                @endif
                            </li>

                        @endif

                    @endforeach

                </ul>

            @endif

        </div>
    </div>

</div>