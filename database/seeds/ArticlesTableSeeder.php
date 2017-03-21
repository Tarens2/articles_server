<?php

use Illuminate\Database\Seeder;
use App\Article;
class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Article();
        $user->title = 'TITLE';
        $user->text = 'text text text text text text text text';
        $user->user_id = 1;
        $user->save();
    }
}
