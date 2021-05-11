<?php

namespace Database\Seeders;
use App\Models\SkuNumber;
use Illuminate\Database\Seeder;

class SkuNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sku=new SkuNumber;
        $sku->save();
    }
}
