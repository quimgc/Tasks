<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\ChecksPermissions;
use Illuminate\Foundation\Http\FormRequest;



class ListTask extends FormRequest
{
    use ChecksPermissions;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        if($this->HasPermissionTo('list-tasks')) return true;
        if ($this->owns('tasks')) return true;
        return false;

        //si l'usuari té el permís ListTask -> autoritzo : no autoritzo.
        //return Auth::user()->HasPermissionTo('list-tasks');
        //si l'usuari té permis sobre list-tasks retornarà True sino retorna False.
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
