<?php
namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = ['Laravel', 'PHP', 'JavaScript', 'Linux', 'IA', 'Web'];

        foreach ($tags as $name) {
            Tag::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}