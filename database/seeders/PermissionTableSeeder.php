<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder

{

    /**
     * Run the database seeds.
     * @return void
     */

    public function run()

    {
       


        $permissions = [
            'VIEW-WALLET',' VIEW WALLET',' EDIT_WALLET_BALANCE',
            'VIEW USERS', 'EDIT USERS' ,'DELETE_USERS','VIEW_RIDE',
            'VIEW_PAYOUT', 'REQUEST_ONLY' , 'EDIT_PAYOUT' , 'APPROVE PAYOUT REQUEST',
            'VIEW ORDERS' , 'EDIT ORDERS', 'CANCEL ORDERS',
            'CREATE_PACKAGES', 'VIEW_PACKAGES', 'MODIFY_PACKAGES',
            'role-view', 'role-create', 'role-edit', 'role-delete',
            'permission-view', 'permission-create', 'permission-edit', 'permission-delete',
            'user-view', 'user-create', 'user-edit', 'user-delete'

        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'admin']);
        }

    }

}