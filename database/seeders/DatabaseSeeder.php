<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{

       /**
     * List of applications to add.
     */
 
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(ModelHasRoleTableSeeder::class);   
    }
}

