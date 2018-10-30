@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('iperformers::types.title.types') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('iperformers::types.title.types') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.iperformers.type.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('iperformers::types.button.create type') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>{{ trans('iperformers::performers.table.id') }}</th>
                                <th>{{ trans('iperformers::performers.table.title') }}</th>
                                <th>{{ trans('iperformers::performers.table.slug') }}</th>
                                <th>{{ trans('iperformers::performers.table.status') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                           @if (isset($types))
                            @foreach ($types as $type)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.iperformers.type.edit', [$type->id]) }}">
                                        {{ $type->id }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.iperformers.type.edit', [$type->id]) }}">
                                        {{ $type->title }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.iperformers.type.edit', [$type->id]) }}">
                                        {{ $type->slug }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.iperformers.type.edit', [$type->id]) }}">
                                            <span class="label {{ $type->present()->statusLabelClass}}">
                                            {{ $type->present()->status}}
                                    </span>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.iperformers.type.edit', [$type->id]) }}">
                                        {{ $type->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.iperformers.type.edit', [$type->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.iperformers.type.destroy', [$type->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('iperformers::performers.table.id') }}</th>
                                <th>{{ trans('iperformers::performers.table.title') }}</th>
                                <th>{{ trans('iperformers::performers.table.slug') }}</th>
                                <th>{{ trans('iperformers::performers.table.status') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('iperformers::types.title.create type') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.iperformers.type.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
