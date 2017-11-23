<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ListTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //si l'usuari té el permís ListTask -> autoritzo : no autoritzo.
        return Auth::user()->HasPermissionTo('list-tasks');
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
