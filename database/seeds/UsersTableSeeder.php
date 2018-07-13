<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::truncate();
        $user = new User();
        
        $user->first_name = "Admin";
        $user->last_name = "Melvin";
        $user->email = "admin@mentechmedia.nl";
        $user->password = bcrypt("password");

        $user->save();

        Bouncer::assign('admin')->to($user);
    }
}
