<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $role=new Role;
        $role->name="admin";
        $role->save();

        $role=new Role;
        $role->name="customer";
        $role->save();


    }
}
