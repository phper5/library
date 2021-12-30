<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('orders')->delete();

        \DB::table('orders')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => 4,
                'book_id' => 5,
                'borrowed_at' => '2021-12-30 07:48:48',
                'returned_at' => NULL,
                'created_at' => '2021-12-30 07:48:48',
                'updated_at' => '2021-12-30 07:48:48',
            ),
        ));


    }
}
