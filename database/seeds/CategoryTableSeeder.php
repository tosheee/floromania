<?php

use Illuminate\Database\Seeder;
use App\Admin\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = "Стайни растения";
        $category->save();

        $category = new Category();
        $category->name = "Градински растения";
        $category->save();

        $category = new Category();
        $category->name = "Балконски растения";
        $category->save();

        $category = new Category();
        $category->name = "Дървета и храсти";
        $category->save();

        $category = new Category();
        $category->name = "Орхидеи";
        $category->save();

        $category = new Category();
        $category->name = "Рози";
        $category->save();

        $category = new Category();
        $category->name = "Семена";
        $category->save();

        $category = new Category();
        $category->name = "Саксии и Кашпи";
        $category->save();

        $category = new Category();
        $category->name = "Торове";
        $category->save();

        $category = new Category();
        $category->name = "Почви";
        $category->save();

        $category = new Category();
        $category->name = "Луковици";
        $category->save();

        $category = new Category();
        $category->name = "Разпродажба-";
        $category->save();

    }
}
