<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'TARAS';
        $user->email = 't@mail.ru';
        $user->password = bcrypt('secret');
        $user->login = "tarens2";
        $user->save();
    }
}
