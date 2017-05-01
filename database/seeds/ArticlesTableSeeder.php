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
        $article = new Article();
        $article->title = 'TITLE';
        $article->text = 'text text text text text text text text';


        $article1 = new Article();
        $article1->title = 'TITLE2';
        $article1->text = 'texqwewqe';

        $article2 = new Article();
        $article2->title = 'TITLE3';
        $article2->text = 'textwqewqe';

        $articles = [
            $article,
            $article1,
            $article2
        ];

        \App\User::find(1)->articles()->saveMany($articles);
    }
}
