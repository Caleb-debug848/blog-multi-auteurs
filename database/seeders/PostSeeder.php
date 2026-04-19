<?php
namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $post = Post::create([
            'title'       => 'Mon premier article',
            'slug'        => Str::slug('Mon premier article'),
            'body'        => 'Ceci est le contenu du premier article du blog.',
            'status'      => 'published',
            'user_id'     => 2,
            'category_id' => 1,
        ]);

        $post->tags()->sync([1, 2]);

        $post2 = Post::create([
            'title'       => 'Introduction à Laravel',
            'slug'        => Str::slug('Introduction à Laravel'),
            'body'        => 'Laravel est un framework PHP moderne et puissant.',
            'status'      => 'published',
            'user_id'     => 2,
            'category_id' => 1,
        ]);

        $post2->tags()->sync([1, 3]);
    }
}