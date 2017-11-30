<?php

namespace App\Http\Requests\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * Trait ChecksPermissions.
 *
 * @package Quimgc\Tasks\Http\Requests\Traits
 */
trait ChecksPermissions
{
    /**
     * Logged as permission to.
     *
     * @param $permission
     * @return bool
     */
    protected function hasPermissionTo($permission)
    {
        if (Auth::user()->hasPermissionTo($permission)) return true;
        return false;
    }

    /**
     * Owns model.
     *
     * @param $model
     * @return bool
     */


    protected function owns($model, $field = 'user_id')
    {
        //todo

        if (Auth::user()->id == $this->$model->$field) return true;
        return false;
    }
}