<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Quimgc\Tasks\Http\Requests\Traits\ChecksPermissions;

class ShowTask extends FormRequest
{
    use ChecksPermissions;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->HasPermissionTo('show-tasks')) return true;
        if ($this->owns('tasks')) return true;
        return false;
        //return Auth::user()->HasPermissionTo('show-tasks');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
