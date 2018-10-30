<div class="box-body">
    <div class='form-group{{ $errors->has("{$lang}.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('iperformers::services.form.title')) !!}
        <?php $old = $service->hasTranslation($lang) ? $service->translate($lang)->title : '' ?>
        {!! Form::text("{$lang}[title]", old("{$lang}.title", $old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('iperformers::services.form.title')]) !!}
        {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
    </div>
    <?php $old = $service->hasTranslation($lang) ? $service->translate($lang)->description : '' ?>
    <div class='form-group{{ $errors->has("$lang.description") ? ' has-error' : '' }}'>
    @editor('content', trans('iperformers::services.form.description'), old("$lang.description", $old), $lang)
    </div>

    <div class="col-xs-12" style="padding-top: 35px;">
        <div class="box box-primary">
            <div class="box-header">
                <div class="box-tools pull-right">
                    <a href="#aditional{{$lang}}" class="btn btn-box-tool" data-target="#aditional{{$lang}}"
                       data-toggle="collapse"><i class="fa fa-minus"></i>
                    </a>
                </div>
                <label>{{ trans('iperformers::common.form.metadata')}}</label>
            </div>
            <div class="box-body ">
                <div class='form-group{{ $errors->has("{$lang}.metatitle") ? ' has-error' : '' }}'>
                    {!! Form::label("{$lang}[metatitle]", trans('iperformers::common.form.metatitle')) !!}
                    <?php $old = $service->hasTranslation($lang) ? $service->translate($lang)->metatitle : '' ?>
                    {!! Form::text("{$lang}[metatitle]", old("{$lang}.metatitle", $old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('iperformers::common.form.metatitle')]) !!}
                    {!! $errors->first("{$lang}.metatitle", '<span class="help-block">:message</span>') !!}
                </div>

                <div class='form-group{{ $errors->has("{$lang}.metakeywords") ? ' has-error' : '' }}'>
                    {!! Form::label("{$lang}[metakeywords]", trans('iperformers::common.form.metakeywords')) !!}
                    <?php $old = $service->hasTranslation($lang) ? $service->translate($lang)->metatitle : '' ?>
                    {!! Form::text("{$lang}[metakeywords]", old("{$lang}.metakeywords", $old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('iperformers::common.form.metakeywords')]) !!}
                    {!! $errors->first("{$lang}.metakeywords", '<span class="help-block">:message</span>') !!}
                </div>

                <?php $old = $service->hasTranslation($lang) ? $service->translate($lang)->metadescription : '' ?>
                @editor('content', trans('iperformers::common.form.metadescription'), old("$lang.metadescription", $old), $lang)
            </div>
        </div>
    </div>



    <?php if (config('asgard.page.config.partials.translatable.edit') !== []): ?>
    <?php foreach (config('asgard.page.config.partials.translatable.edit') as $partial): ?>
    @include($partial)
    <?php endforeach; ?>
    <?php endif; ?>
</div>
