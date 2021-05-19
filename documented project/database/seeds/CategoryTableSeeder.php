<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path();

        Category::create(
            [
                'name' => 'cpp',
                'url' => '/img/c.png',
            ]
        );

        Category::create(
            [
                'name' => 'java',
                'url' => '/img/java.jpg',
            ]
        );

        Category::create(
            [
                'name' => 'php',
                'url' => '/img/php.png',
            ]
        );

        Category::create(
            [
                'name' => 'xml',
                'url' => '/img/xml.png',
            ]
        );

        Category::create(
            [
                'name' => 'js',
                'url' => '/img/javascript.png',
            ]
        );

        Category::create(
            [
                'name' => 'nodeJS',
                'url' => '/img/nodejs.png',
            ]
        );

        Category::create(
            [
                'name' => 'html',
                'url' => '/img/html.png',
            ]
        );

        Category::create(
            [
                'name' => 'jQuery',
                'url' => '/img/jquery.png',
            ]
        );
    }
}
