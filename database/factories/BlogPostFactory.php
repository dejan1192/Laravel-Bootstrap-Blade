<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all();
        if($users->count() === 0){
            return;
        }

        return [
            'title'=>$this->faker->sentence(),
            'content'=>$this->faker->paragraph(),
            'user_id'=>$users->random()->id
        ];
    }
}
