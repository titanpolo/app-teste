<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdatePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // utiliza o segmento 3 da url pra pegar o id (para tratar edição de post com título único)
        //se eu mudar o path das rotas vou ter que mexer aqui
        $id = $this->segment(3);

        $rules = [
            'title'=>['required',
                'min:3',
                'max:160',
                //"unique:posts,title,{$id},id",
                Rule::unique('posts')->ignore($id),
            ],
            'content'=>['nullable','min:5', 'max:10000'],
            'image'=>['required', 'image']
        ];

        if($this->method() == 'PUT'){
            $rules['image'] = ['nullable', 'image'];
        }

        return $rules;
    }
}
