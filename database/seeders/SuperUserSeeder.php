<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=new User;
        $user->first_name="super";
        $user->last_name="super";
        $user->email="super@gmail.com";
        $user->password=bcrypt('password');
        $user->phone='123456';
        $user->country='Pakistan';
        $user->state='Punjab';
        $user->address='House No ABC';
        $user->save();

        $user->assignRole('admin');
    }
}
