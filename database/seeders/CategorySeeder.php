<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        $categories = [
            ['id' => 1, 'name' => 'Отдых'],
            ['id' => 2, 'name' => 'Cпорт'],
            ['id' => 3, 'name' => 'Развитие'],
            ['id' => 4, 'name' => 'Книги'],
            ['id' => 5, 'name' => 'Кино'],
            ['id' => 6, 'name' => 'Сериалы'],
            ['id' => 7, 'name' => 'Политика'],
            ['id' => 8, 'name' => 'Развлечения'],
            ['id' => 9, 'name' => 'Авто'],
            ['id' => 10, 'name' => 'Мото']
        ];

        DB::table('categories')->insert($categories);
    }
}
