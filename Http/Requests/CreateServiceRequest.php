<?php

namespace Modules\Iperformers\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateServiceRequest extends BaseFormRequest
{
    public function rules()
    {
        return [];
    }

    public function translationRules()
    {
        return [
            'title'=>'required:min2',
            'description'=>'required:min2',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [
            'title.required' => trans('iperformers::messages.name is required'),
            'title.min2'=>trans('iperformers::messages.name is min 2'),
            'description.required' => trans('iperformers::messages.description is required'),
            'description.min2'=>trans('iperformers::messages.description is min '),
        ];
    }
}
