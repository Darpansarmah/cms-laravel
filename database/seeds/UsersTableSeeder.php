<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::where('email', 'hellodarpan1.ds@gmail.com')->first();

        if(!$user) {

            User::create([

                'name'=>'Darpan Sarmah',
                'email'=>'hellodarpan1.ds@gmail.com',
                'role'=>'admin',
                'password'=> Hash::make('password')     

            ]);

        }

    }
}
