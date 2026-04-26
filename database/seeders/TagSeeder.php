<?php
namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
{
    \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    Tag::truncate(); // ou Post::truncate();
    \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $tags = [
            'Cameroun',         // 1
            'Économie',         // 2
            'Agriculture',      // 3
            'Numérique',        // 4
            'Télécommunications', // 5
            'Douane',           // 6
            'Emploi',           // 7
            'Énergie',          // 8
            'Transport',        // 9
            'Santé',            // 10
            'Intelligence Artificielle', // 11
            'Mobilité Verte',   // 12
        ];

        foreach ($tags as $name) {
            Tag::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}