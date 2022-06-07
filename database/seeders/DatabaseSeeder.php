<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tag = Tag::factory(5)->create();
        User::factory(10)->create()
            ->each(function ($query) use ($tag){
                Listing::factory(rand(1,4))->create([
                    'user_id' => $query->id
                ])->each(function ($listing) use ($tag){
                    $listing->tags()->attach($tag->random(2));
                });
            });
    }
}
