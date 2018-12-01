<div class="row checkbox">

    <div class="col-xs-12">
        <div class="content-cat" style="max-height:490px;overflow-y: auto;">

            <label for="related"><strong>{{trans('iperformers::performers.table.related')}}</strong></label>


            @if(count($related)>0)
                @php
                    if(isset($performer->related) && count($performer->related)>0){
                    $oldCat = array();
                        foreach ($performer->related as $cat){
                                   array_push($oldCat,$cat->id);
                               }

                           }else{
                           $oldCat=old('related');
                           }
                @endphp

                <ul class="checkbox" style="list-style: none;padding-left: 5px;">

                    @foreach ($related as $type)
                        @if($type->parent_id==0)
                            <li  style="padding-top: 5px">
                                <label>
                                    <input type="checkbox" class="flat-blue jsInherit" name="related[]"

                                           value="{{$type->id}}"
                                           @isset($oldCat) @if(in_array($type->id, $oldCat)) checked="checked" @endif @endisset> {{$type->title}}
                                </label>
                                @if(count($type->children)>0)
                                    @php
                                        $children=$type->children
                                    @endphp
                                    @include('iperformers::admin.fields.checklist.related.children',['children'=>$children])
                                @endif
                            </li>

                        @endif

                    @endforeach

                </ul>

            @endif

        </div>
    </div>

</div>