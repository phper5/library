<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('books')->delete();

        \DB::table('books')->insert(array (
            0 =>
            array (
                'id' => 1,
                'title' => 'C++',
                'edition' => 'v1',
                'in_library' => 1,
                'category_id' => 1,
                'created_at' => '2021-12-28 10:59:58',
                'updated_at' => '2021-12-29 03:35:19',
            ),
            1 =>
            array (
                'id' => 2,
                'title' => 'Java',
                'edition' => 'v1',
                'in_library' => 1,
                'category_id' => 1,
                'created_at' => '2021-12-28 10:59:58',
                'updated_at' => '2021-12-30 04:16:15',
            ),
            2 =>
            array (
                'id' => 3,
                'title' => 'PHP',
                'edition' => 'v2',
                'in_library' => 1,
                'category_id' => 1,
                'created_at' => '2021-12-28 10:59:58',
                'updated_at' => '2021-12-29 03:45:58',
            ),
            3 =>
            array (
                'id' => 4,
                'title' => 'China',
                'edition' => 'v1',
                'in_library' => 1,
                'category_id' => 2,
                'created_at' => '2021-12-28 10:59:58',
                'updated_at' => '2021-12-30 04:24:15',
            ),
            4 =>
            array (
                'id' => 5,
                'title' => 'book',
                'edition' => '123',
                'in_library' => 0,
                'category_id' => 4,
                'created_at' => '2021-12-30 05:04:41',
                'updated_at' => '2021-12-30 07:48:48',
            ),
        ));


    }
}
