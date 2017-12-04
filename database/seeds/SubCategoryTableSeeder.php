<?php

use Illuminate\Database\Seeder;
use App\Admin\Category;
use App\Admin\SubCategory;

class SubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_category = new SubCategory();
        $sub_category->category_id = Category::where('name', 'Орхидеи')->first()->id;
        $sub_category->name = 'Градински Орхидеи';
        $sub_category->identifier = 'garden_orchid';
        $sub_category->save();

        $sub_category = new SubCategory();
        $sub_category->category_id = Category::where('name', 'Орхидеи')->first()->id;
        $sub_category->name = 'Зигопеталум';
        $sub_category->identifier = 'zigopetalum';
        $sub_category->save();

        $sub_category = new SubCategory();
        $sub_category->category_id = Category::where('name', 'Орхидеи')->first()->id;
        $sub_category->name = 'Камбрия';
        $sub_category->identifier = 'kambia';
        $sub_category->save();


        $sub_category = new SubCategory();
        $sub_category->category_id = Category::where('name', 'Орхидеи')->first()->id;
        $sub_category->name = 'Пафиопедилум';
        $sub_category->identifier = 'pafiopedium';
        $sub_category->save();

        $sub_category = new SubCategory();
        $sub_category->category_id = Category::where('name', 'Градински растения')->first()->id;
        $sub_category->name = 'Водни растения';
        $sub_category->identifier = 'water_plants';
        $sub_category->save();

        $sub_category = new SubCategory();
        $sub_category->category_id = Category::where('name', 'Градински растения')->first()->id;
        $sub_category->name = 'За балкона';
        $sub_category->identifier = 'for_the_balcony';
        $sub_category->save();

        $sub_category = new SubCategory();
        $sub_category->category_id = Category::where('name', 'Градински растения')->first()->id;
        $sub_category->name = 'За градината';
        $sub_category->identifier = 'for_the_garden';
        $sub_category->save();

        $sub_category = new SubCategory();
        $sub_category->category_id = Category::where('name', 'Стайни растения')->first()->id;
        $sub_category->name = 'Цъфтящи';
        $sub_category->identifier = 'flowering';
        $sub_category->save();

        $sub_category = new SubCategory();
        $sub_category->category_id = Category::where('name', 'Стайни растения')->first()->id;
        $sub_category->name = 'Листнодекоративни';
        $sub_category->identifier = 'leaf_decorative';
        $sub_category->save();

        $sub_category = new SubCategory();
        $sub_category->category_id = Category::where('name', 'Стайни растения')->first()->id;
        $sub_category->name = 'Кактуси и сукуленти';
        $sub_category->identifier = 'cacti_and_succulents';
        $sub_category->save();

        $sub_category = new SubCategory();
        $sub_category->category_id = Category::where('name', 'Стайни растения')->first()->id;
        $sub_category->name = 'Бонсаи';
        $sub_category->identifier = 'bonsai';
        $sub_category->save();

        $sub_category = new SubCategory();
        $sub_category->category_id = Category::where('name', 'Стайни растения')->first()->id;
        $sub_category->name = 'Палми';
        $sub_category->identifier = 'palm';
        $sub_category->save();

        $sub_category = new SubCategory();
        $sub_category->category_id = Category::where('name', 'Рози')->first()->id;
        $sub_category->name = 'Рози';
        $sub_category->identifier = 'rose';
        $sub_category->save();
    }
}
