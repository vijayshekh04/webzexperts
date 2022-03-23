<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cname = array('AAA','BBB','CCC','DDD','EEE');
        for ($i=0;$i<5;$i++)
        {
            $category['Catname'] = $cname[$i];
            $category['Status'] = "Active";
            Category::create($category);
        }
    }
}
