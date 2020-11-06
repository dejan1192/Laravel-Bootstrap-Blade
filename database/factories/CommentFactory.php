<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all();
        $posts = BlogPost::all();

        if($users->count() === 0 && $posts->count() === 0){
            return;
        }

        return [
            'content'=> $this->faker->paragraph(),
            'user_id'=> $users->random()->id,
            'blog_post_id'=>$posts->random()->id
        ];
    }
}
