<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /**
         * For seeding
         * 
         **/
         $users = User::all()->pluck('id')->random();
         
        //$users = Auth::user()->factory()->create()->id;

        return [
            'article_title' => $this->faker->sentence(),
            'article_description' => $this->faker->sentence(),
            'created_by' => $users,
            'created_on' => now(),
        ];
    }
}
