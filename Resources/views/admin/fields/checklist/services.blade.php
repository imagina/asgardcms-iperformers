<div class="row checkbox">

    <div class="col-xs-12">
        <div class="content-serv" style="max-height:490px;overflow-y: auto;">
            @if(count($types)>0)
                @php
                    if(isset($performer->services) && count($performer->services)>0){
                    $oldServ = array();
                        foreach ($performer->services as $serv){
                                   array_push($oldServ,$serv->id);
                               }

                           }else{
                           $oldServ=old('services');
                           }
                @endphp

                <ul class="checkbox" style="list-style: none;padding-left: 5px;">

                    @foreach ($services as $service)
                      
                            <li style="padding-top: 5px">
                                <label>
                                    <input type="checkbox" class="flat-blue jsInherit" name="services[]"
                                           value="{{$service->id}}"
                                           @isset($oldServ) @if(in_array($service->id, $oldServ)) checked="checked" @endif @endisset> {{$service->title}}
                                </label>
                              
                            </li>


                    @endforeach

                </ul>

            @endif

        </div>
    </div>

</div>