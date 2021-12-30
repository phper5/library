<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('categories')->delete();

        \DB::table('categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Computer',
                'created_at' => '2021-12-28 10:59:37',
                'updated_at' => '2021-12-28 10:59:37',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'History',
                'created_at' => '2021-12-28 12:33:18',
                'updated_at' => '2021-12-28 12:33:18',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Math',
                'created_at' => '2021-12-30 04:08:07',
                'updated_at' => '2021-12-30 04:08:07',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Poetry',
                'created_at' => '2021-12-30 06:26:02',
                'updated_at' => '2021-12-30 06:26:02',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Novel',
                'created_at' => '2021-12-30 06:26:41',
                'updated_at' => '2021-12-30 06:26:41',
            ),
        ));


    }
}
