<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_create_a_comment_on_random_post()
    {
        $comment = Comment::factory()->make(['level' => 0]);
        $response = $this->postJson('/api/comments/', $comment->toArray());
        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_get_all_comments_for_post_id_equal_one()
    {
        Comment::factory()
            ->count(10)
            ->create(['level' => 0, 'post_id' => 1]);
        $response = $this->getJson('/api/comments/1');
        $response->assertStatus(200);
    }
}
