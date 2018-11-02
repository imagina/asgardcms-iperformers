<div class="box-body">
    <div class='form-group{{ $errors->has("{$lang}.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('iperformers::performers.form.title')) !!}
        <?php $old = $performer->hasTranslation($lang) ? $performer->translate($lang)->title : '' ?>
        {!! Form::text("{$lang}[title]", old("{$lang}.title", $old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('iperformers::performers.form.title')]) !!}
        {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
    </div>

    <div class='form-group{{ $errors->has("{$lang}[slug]") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[slug]", trans('iperformers::performers.form.slug')) !!}
        <?php $old = $performer->hasTranslation($lang) ? $performer->translate($lang)->slug : '' ?>
        {!! Form::text("{$lang}[slug]", old("{$lang}.slug", $old), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('iperformers::performers.form.slug')]) !!}
        {!! $errors->first("{$lang}.slug", '<span class="help-block">:message</span>') !!}
    </div>

    <?php $old = $performer->hasTranslation($lang) ? $performer->translate($lang)->description : '' ?>
    <div class='form-group{{ $errors->has("$lang.description") ? ' has-error' : '' }}'>
        @editor('description', trans('iperformers::performers.form.description'), old("$lang.description", $old), $lang)
    </div>
    <div class="col-xs-12" style="padding-top: 35px;">
        <div class="panel box box-primary">
            <div class="box-header">
                <div class="box-tools pull-right">
                    <a href="#aditional{{$lang}}" class="btn btn-box-tool" data-target="#aditional{{$lang}}"
                       data-toggle="collapse"><i class="fa fa-minus"></i>
                    </a>
                </div>
                <label>{{ trans('iperformers::common.form.metadata')}}</label>
            </div>
            <div class="panel-collapse collapse in" id="aditional{{$lang}}">
                <div class="box-body ">
                    <div class='form-group{{ $errors->has("{$lang}.metatitle") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[metatitle]", trans('iperformers::performers.form.metatitle')) !!}
                        <?php $old = $performer->hasTranslation($lang) ? $performer->translate($lang)->metatitle : '' ?>
                        {!! Form::text("{$lang}[metatitle]", old("{$lang}.metatitle", $old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('iperformers::performers.form.metatitle')]) !!}
                        {!! $errors->first("{$lang}.metatitle", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class='form-group{{ $errors->has("{$lang}.metakeywords") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[metakeywords]", trans('iperformers::performers.form.metakeywords')) !!}
                        <?php $old = $performer->hasTranslation($lang) ? $performer->translate($lang)->metakeywords : '' ?>
                        {!! Form::text("{$lang}[metakeywords]", old("{$lang}.metakeywords", $old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('iperformers::performers.form.metakeywords')]) !!}
                        {!! $errors->first("{$lang}.metakeywords", '<span class="help-block">:message</span>') !!}
                    </div>

                    <?php $old = $performer->hasTranslation($lang) ? $performer->translate($lang)->metadescription : '' ?>
                    @editor('content', trans('iperformers::performers.form.metadescription'), old("$lang.metadescription",
                    $old),
                    $lang)
                </div>
            </div>
        </div>
    </div>

    <?php if (config('asgard.page.config.partials.translatable.edit') !== []): ?>
    <?php foreach (config('asgard.page.config.partials.translatable.edit') as $partial): ?>
    @include($partial)
    <?php endforeach; ?>
    <?php endif; ?>

</div>
@section('scripts')
    @parent
    <style>


    </style>
@stop
