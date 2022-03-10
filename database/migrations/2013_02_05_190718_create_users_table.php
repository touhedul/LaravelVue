<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use Str;
class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
            $table->string('provider')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });


        User::create(
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@admin.com',
                'password' => bcrypt('456456456'),
                'phone' => '01833996321',
                'address' => 'Demo Address',
                'image' => 'user.jpg',
                'email_verified_at' => now(),
                'remember_token' => rand(100,1000000),
            ]
        );
        User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('456456456'),
                'phone' => '01833996321',
                'address' => 'Demo Address',
                'image' => 'user.jpg',
                'email_verified_at' => now(),
                'remember_token' => rand(100,1000000),
            ]
        );
        User::create(
            [
                'name' => 'Staff',
                'email' => 'staff@admin.com',
                'password' => bcrypt('456456456'),
                'phone' => '01833996321',
                'address' => 'Demo Address',
                'image' => 'user.jpg',
                'email_verified_at' => now(),
                'remember_token' => rand(100,1000000),
            ]
        );
        User::create(
            [
                'name' => 'user-a',
                'email' => 'a@a.com',
                'password' => bcrypt('12345678'),
                'phone' => '01833996321',
                'address' => 'Demo Address',
                'image' => 'user.jpg',
                'email_verified_at' => now(),
                'remember_token' => rand(100,1000000),
            ]
        );
        User::create(
            [
                'name' => 'user-b',
                'email' => 'b@b.com',
                'password' => bcrypt('12345678'),
                'phone' => '01833996321',
                'address' => 'Demo Address',
                'image' => 'user.jpg',
                'email_verified_at' => now(),
                'remember_token' => rand(100,1000000),
            ]
        );
        User::create(
            [
                'name' => 'user-ac',
                'email' => 'c@c.com',
                'password' => bcrypt('12345678'),
                'phone' => '01833996321',
                'address' => 'Demo Address',
                'image' => 'user.jpg',
                'email_verified_at' => now(),
                'remember_token' => rand(100,1000000),
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
