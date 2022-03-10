<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::factory(5)->has(
            \App\Models\Serie::factory()
            ->has(
                Comment::factory()->count(5)
                )
                ->count(5)
                )->create();

        //Ajout d'un user avec le role admin (email : admin@mail.com, password:adminadmin)
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@mail.com';
        $admin->email_verified_at = now();
        $admin->password = Hash::make('adminadmin');
        $admin->role = 'admin';
        $admin->save();
        event(new Registered($admin));

        //Ajout d'un user avec le role user (email : user@mail.com, password:useruser)
        $user = new User();
        $user->name = 'user';
        $user->email = 'user@mail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('useruser');
        $user->role = 'user';
        $user->save();
        event(new Registered($user));
    }
}
