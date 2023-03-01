<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CRUDPostTest extends TestCase
{
        public function testCreate_Post()
    {
        $post = Post::factory()->create();
        $this->json(
            'POST',
            'api/admin/create-post',
            [
                'title' => $post->title,
                'content' => $post->content,
                'image' => $post->image,
            ]
        )->json(['status' => true]);
        $this->assertDatabaseHas('post', $post->toArray());
    }

    public function testUpdate_Post()
    {
        $post = Post::factory()->create();
        $id = $post->id;
        $this->json(
            'POST',
            "api/admin/update-post/{$id}",
            [
                'title' => 'Test',
                'content' => 'Check',
                'image' => 'Avartar.jpg'
            ]
        )->assertJson(['status' => true]);
    }

//    public function testDelete_Post()
//    {
//        $post = Post::factory()->create();
//        $id = $post->id;
//        $this->json(
//            'POST',
//            "api/admin/delete-post/{$id}",
//        )->assertJson(['status' => true]);
//    }
}
