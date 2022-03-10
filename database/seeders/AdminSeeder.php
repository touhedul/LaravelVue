<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory()->count(2)->create();
        Admin::create(['name'=>'Admin','email' => 'admin@admin,com','password' => bcrypt('10109914admin'), 'super_admin' => 1,'remember_token' => Str::random(10),]);
    }
}
