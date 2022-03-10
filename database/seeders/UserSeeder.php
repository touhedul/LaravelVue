<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create(
        //     [
        //         'name' => 'Super Admin',
        //         'email' => 'superadmin@admin.com',
        //         'password' => bcrypt('456456456'),
        //         'phone' => '01833996321',
        //         'address' => 'Demo Address',
        //         'image' => 'user.jpg',
        //         'email_verified_at' => now(),
        //         'remember_token' => Str::random(10),
        //     ]
        // );
        // User::create(
        //     [
        //         'name' => 'Admin',
        //         'email' => 'admin@admin.com',
        //         'password' => bcrypt('456456456'),
        //         'phone' => '01833996321',
        //         'address' => 'Demo Address',
        //         'image' => 'user.jpg',
        //         'email_verified_at' => now(),
        //         'remember_token' => Str::random(10),
        //     ]
        // );
        // User::create(
        //     [
        //         'name' => 'Staff',
        //         'email' => 'staff@admin.com',
        //         'password' => bcrypt('456456456'),
        //         'phone' => '01833996321',
        //         'address' => 'Demo Address',
        //         'image' => 'user.jpg',
        //         'email_verified_at' => now(),
        //         'remember_token' => Str::random(10),
        //     ]
        // );
        // User::create(
        //     [
        //         'name' => 'user-a',
        //         'email' => 'a@a.com',
        //         'password' => bcrypt('12345678'),
        //         'phone' => '01833996321',
        //         'address' => 'Demo Address',
        //         'image' => 'user.jpg',
        //         'email_verified_at' => now(),
        //         'remember_token' => Str::random(10),
        //     ]
        // );
        // User::create(
        //     [
        //         'name' => 'user-b',
        //         'email' => 'b@b.com',
        //         'password' => bcrypt('12345678'),
        //         'phone' => '01833996321',
        //         'address' => 'Demo Address',
        //         'image' => 'user.jpg',
        //         'email_verified_at' => now(),
        //         'remember_token' => Str::random(10),
        //     ]
        // );
        // User::create(
        //     [
        //         'name' => 'user-ac',
        //         'email' => 'c@c.com',
        //         'password' => bcrypt('12345678'),
        //         'phone' => '01833996321',
        //         'address' => 'Demo Address',
        //         'image' => 'user.jpg',
        //         'email_verified_at' => now(),
        //         'remember_token' => Str::random(10),
        //     ]
        // );
        // User::factory()->count(2)->create();
    }
}
