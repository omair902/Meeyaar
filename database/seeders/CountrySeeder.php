<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $country=new Country;
        $country->name='Pakistan';
        $country->save();
        
        $country=new Country;
        $country->name='United States';
        $country->save();
        
        $country=new Country;
        $country->name='United Kingdom';
        $country->save();
        
        $country=new Country;
        $country->name='Canada';
        $country->save();
    }
}
