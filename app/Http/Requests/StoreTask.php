<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasPermissionTo('list-tasks');

//        if ($this->hasPermissionTo('store-tasks')) return true;
//        if (Auth::user()->id === $this->user_id) return true;
//        return false;
        //return Auth::user()->HasPermissionTo('store-tasks');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return[
            'name'    => 'required',
            'user_id' => 'required',
            'description' => 'required',
        ];
    }
}
