<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company')->insert([
            'name'    => 'keratin soft',
            'email'   => 'info@kertintech.com',
            'phone'   => 7777777777,
        ]);

         DB::table('users')->insert([
             'name'    => 'Ali',
             'email'   => 'demo@keratin.com',
             'password'=> Hash::make('demo'),
             'company_id'  =>1,
             'user_type'   =>1,

         ]);
        DB::table('users')->insert([
            'name'    => 'Ali Ahmad',
            'email'   => 'demo@kertintech.com',
            'password'=> Hash::make('demo'),
            'company_id'  =>1,
            'user_type'   =>1,

        ]);

    }
}
