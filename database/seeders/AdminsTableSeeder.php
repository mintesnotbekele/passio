<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		'name' => 'superadmin',
    		'email' => 'superadmin@admin.com',
    		'password' => Hash::make('123456'),
    		'created_at' => date('Y-m-d'),
    		'updated_at' => date('Y-m-d')
    	]);
    }
}
