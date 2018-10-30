@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('iperformers::performers.title.edit performer') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i
                        class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.iperformers.performer.index') }}">{{ trans('iperformers::performers.title.performers') }}</a></li>
        <li class="active">{{ trans('iperformers::performers.title.edit performer') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.iperformers.performer.update', $performer->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-xs-12 col-md-9">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div class="nav-tabs-custom">
                            @include('partials.form-tab-headers')
                            <div class="tab-content">
                                <?php $i = 0; ?>
                                @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                                    <?php $i++; ?>
                                    <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                        @include('iperformers::admin.performers.partials.edit-fields', ['lang' => $locale])
                                    </div>
                                @endforeach
                            </div> {{-- end nav-tabs-custom --}}
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                        </div>
                        <div class="box-body ">
                            <div class="box-footer">
                                <button type="submit"
                                        class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                                <a class="btn btn-danger pull-right btn-flat"
                                   href="{{ route('admin.iperformers.performer.index')}}">
                                    <i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <label>{{trans('iperformers::performers.title.types')}}</label>
                            </div>
                        </div>
                        <div class="box-body">
                            <label for="types"><strong>{{trans('iperformers::performers.form.principal')}}</strong></label>
                            <select class="form-control" name="type_id">
                                @if(count($types))
                                    @foreach ($types as $type)
                                        <option value="{{$type->id}}" {{ old('type_id',$performer->type_id) == $type->id ? 'selected' : '' }}> {{$type->title}}
                                        </option>
                                    @endforeach
                                @endif
                            </select><br>
                        </div>
                        <div class="box-body">
                            @include('iperformers::admin.fields.checklist.parent')
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <label>{{trans('iperformers::genres.form.genres')}}</label>
                            </div>
                        </div>
                        <div class="box-body">
                            <label for="genres"><strong>{{trans('iperformers::genres.form.principal')}}</strong></label>
                            <select class="form-control" name="genre_id" id="genre_id">
                                @foreach ($genres as $genre)
                                    <option value="{{$genre->id}}"{{ old('genre_id', $performer->genre_id) == $genre->id ? 'selected' : '' }} > {{$genre->title}}
                                    </option>
                                @endforeach
                            </select><br>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <label>{{trans('iperformers::common.form.cities')}}</label>
                            </div>
                        </div>
                        <div class="box-body">
                            <label for="cities"><strong>{{trans('iperformers::genres.form.principal')}}</strong></label>
                            <select class="form-control" name="city_id" id="city_id">
                                @foreach ($cities as $city)
                                    <option value="{{$city->id}}" {{ old('city_id', $performer->city_id ) == $city->id ? 'selected' : '' }}> {{$city->name}}
                                    </option>
                                @endforeach
                            </select><br>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <label>{{trans('iperformers::services.form.services')}}</label>
                            </div>
                        </div>
                        <div class="box-body">
                            @include('iperformers::admin.fields.checklist.services')
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header">
                            <label>{{trans('iperformers::status.title')}}</label>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body ">
                            <div class='form-group{{ $errors->has("status") ? ' has-error' : '' }}'>
                                <label class="radio" for="{{trans('iperformers::status.inactive')}}">
                                    <input type="radio" id="status" name="status"
                                           value="0" {{ old('status',$performer->status) == 0? 'checked' : '' }}>
                                    {{trans('iperformers::status.inactive')}}
                                </label>
                                <label class="radio" for="{{trans('iperformers::status.active')}}">
                                    <input type="radio" id="status" name="status"
                                           value="1" {{ old('status',$performer->status) == 1? 'checked' : '' }}>
                                    {{trans('iperformers::status.active')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                            </div>
                            <div class="box-body">
                                @include('iperformers::admin.fields.image',['entity'=>$performer])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 ">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                            <label>User</label>
                        </div>
                        <div class="box-body">
                            <select name="user_id" id="user" class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{$user->id }}" {{$user->id == $currentUser->id ? 'selected' : ''}}>{{$user->present()->fullname()}}
                                        - ({{$user->email}})
                                    </option>
                                @endforeach
                            </select><br>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).keypressAction({
                actions: [
                    {key: 'b', route: "<?= route('admin.iperformers.performer.index') ?>"}
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
            $('.btn-box-tool').click(function (e) {
                e.preventDefault();
            });
        });
    </script>
    <style>

        .nav-tabs-custom > .nav-tabs > li.active {
            border-top-color: white !important;
            border-bottom-color: #3c8dbc !important;
        }

        .nav-tabs-custom > .nav-tabs > li.active > a, .nav-tabs-custom > .nav-tabs > li.active:hover > a {
            border-left: 1px solid #e6e6fd !important;
            border-right: 1px solid #e6e6fd !important;

        }
    </style>
@endpush

