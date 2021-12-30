<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'adminxy',
                'email' => 'w@w.com',
                'role' => 1,
                'email_verified_at' => NULL,
                'password' => '$2y$10$3LoANdo1SKYoXRfsFvSTl.62dP/M1rKA9RvqTOAkJM6v93FW8xwd2',
                'remember_token' => NULL,
                'created_at' => '2021-12-28 06:38:28',
                'updated_at' => '2021-12-29 15:22:20',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'sdfdf',
                'email' => 'a@a.com',
                'role' => 0,
                'email_verified_at' => NULL,
                'password' => '$2y$10$.cmU.XOeW1tYW3y3VhHMBOAE0uUwI56aDPckFFnDrFQhzIp5WsyEa',
                'remember_token' => NULL,
                'created_at' => '2021-12-29 12:11:34',
                'updated_at' => '2021-12-29 12:11:34',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'b',
                'email' => 'b@b.com',
                'role' => 0,
                'email_verified_at' => NULL,
                'password' => '$2y$10$q2I43YGNLpZzWd5voktt/OSOvbIAA8SE.kTcTXiLzEL8NGTvM5SxO',
                'remember_token' => NULL,
                'created_at' => '2021-12-29 12:12:15',
                'updated_at' => '2021-12-29 12:12:15',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'c',
                'email' => 'c@c.com',
                'role' => 1,
                'email_verified_at' => NULL,
                'password' => '$2y$10$VBTkU5jmAlVEOBUPD1JEyejsZvonYDgTM/xdH/Cwr9Z0MLpqDdc/W',
                'remember_token' => NULL,
                'created_at' => '2021-12-29 12:13:01',
                'updated_at' => '2021-12-30 04:17:57',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'd',
                'email' => 'd@d.com',
                'role' => 0,
                'email_verified_at' => NULL,
                'password' => '$2y$10$4z1Fa3y7MFNoi5tlwMhIXOooysKxWFDQep9QOQ/8n1x3dNM/49N.6',
                'remember_token' => NULL,
                'created_at' => '2021-12-29 12:15:15',
                'updated_at' => '2021-12-29 15:03:17',
            ),
        ));


    }
}
