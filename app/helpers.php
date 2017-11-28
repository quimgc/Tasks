<?php


use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

//funció creada per veure si el rol ja te assignat un permís, si el te no fem res, sino li assignem.
// si no es fa així provoca error:
//Illuminate\Database\QueryException with message 'SQLSTATE[23000]: Integrity constraint violation: 19 UNIQUE constraint failed: role_has_permissions.permission_id, role_has_permissions.role_id (SQL: insert into "role_has_permissions" ("permission_id", "role_id") values (1, 1))'
if(!function_exists('assignPermission')){

    /**
     * @param $role
     * @param $permission
     */
    function assignPermission($role, $permission){

        if(! $role->HasPermissionTo($permission)){
            $role->HasPermissionTo($permission);
        }
    }
}

if (!function_exists('initialize_task_permissions')) {
    function initialize_task_permissions()
    {

        //Crea només si no existeix
        Permission::firstOrCreate(['name'=>'list-tasks']);
        Permission::firstOrCreate(['name'=>'show-tasks']);
        Permission::firstOrCreate(['name'=>'store-tasks']);
        Permission::firstOrCreate(['name'=>'update-tasks']);
        Permission::firstOrCreate(['name'=>'destroy-tasks']);

        $role = Role::firstOrCreate(['name'=>'task-manager']);

        assignPermission($role,'list-tasks');
        assignPermission($role,'show-tasks');
        assignPermission($role,'store-tasks');
        assignPermission($role,'update-tasks');
        assignPermission($role,'destroy-tasks');

        Permission::firstOrCreate(['name' => 'list-users']);
        Permission::firstOrCreate(['name' => 'show-users']);
        Permission::firstOrCreate(['name' => 'store-users']);
        Permission::firstOrCreate(['name' => 'update-users']);
        Permission::firstOrCreate(['name' => 'destroy-users']);

        $role = Role::firstOrCreate(['name' => 'users-manager']);

       assignPermission($role,'list-users');
       assignPermission($role,'show-users');
       assignPermission($role,'store-users');
       assignPermission($role,'update-users');
       assignPermission($role,'destroy-users');

    }
}


if (!function_exists('create_user')) {
    function create_user()
    {
        factory(User::class)->create([
            'name'     => env('TASKS_USER_NAME', 'Quim González Colat'),
            'email'    => env('TASKS_USER_EMAIL', 'quimgonzalez@iesebre.com'),
            'password' => bcrypt(env('TASKS_USER_PASSWORD')),
        ]);
    }
}

if (!function_exists('first_user_as_task_manager')) {
    function first_user_as_task_manager()
    {
        User::all()->first()->assignRole('task-manager');
        User::all()->first()->assignRole('users-manager');
    }
}
