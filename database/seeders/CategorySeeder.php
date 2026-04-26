<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
{
    \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    Category::truncate();
    \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            'Actualité Cameroun',     // 1
            'Tech & Innovation',      // 2
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}