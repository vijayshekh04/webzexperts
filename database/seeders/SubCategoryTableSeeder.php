<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = array('aaa','bbb','ccc','ddd','eee');
        $j = 0;
        for ($i=1;$i<5;$i++)
        {
            $sub_category['Cat_id'] = $i;
            $sub_category['Subcat_name'] = $name[$j];
            $sub_category['Status'] = "Active";
            SubCategory::create($sub_category);
            $j++;
        }
    }
}
