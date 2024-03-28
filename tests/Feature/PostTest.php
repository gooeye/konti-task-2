<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class PostTest extends TestCase
{
    use WithFaker;

    public function test_can_create_post()
    {
        // Prepare test data
        $postData = [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph()
        ];

        // Make API call
        $response = $this->postJson(route('posts.store'), $postData);

        // Assertions
        $response->assertStatus(201) // Created
            ->assertJson([
                'message' => true,
                'post' => [
                    'title' => $postData['title'],
                    'content' => $postData['content'],
                    'id' => true,
                ]
            ]);
    }

    public function test_post_creation_requires_title_and_content()
    {
        $response = $this->postJson(route('posts.store'), []); // Missing data

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'content']);
    }

    public function test_can_delete_post()
    {
        $postData = [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph()
        ];

        $createResponse = $this->postJson(route('posts.store'), $postData);
        $postId = $createResponse->json('post.id');

        // Deletion call
        $response = $this->deleteJson(route('posts.destroy', $postId));

        // Assertions
        $response->assertStatus(200)
            ->assertJson([
                'message' => True
            ]);

        // Confirm deletion from database
        $this->assertDatabaseMissing('posts', ['id' => $postId]);
    }

    public function test_can_get_all_posts()
    {
        // Create a few test posts
        $postData = [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph()
        ];
        $this->postJson(route('posts.store'), $postData);
        $this->postJson(route('posts.store'), $postData);

        $response = $this->getJson(route('posts.index'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [ // Check the structure of each post within the array
                    'id', 'title', 'content'
                ]
            ]);
    }

    public function test_can_get_post_by_id()
    {
        // Create a test post
        $postData = ['title' => 'Test Post', 'content' => 'Sample Content'];
        $response = $this->postJson(route('posts.store'), $postData);
        $postId = $response->json('post.id');

        // Fetch the post by ID
        $getResponse = $this->getJson(route('posts.show', $postId));

        // Assertions
        $getResponse->assertStatus(200)
            ->assertJson([
                'id' => $postId,
                'title' => $postData['title'],
                'content' => $postData['content']
            ]);
    }

    public function test_can_update_post()
    {
        // Create a test post
        $postData = ['title' => 'Original Title', 'content' => 'Original Content'];
        $response = $this->postJson(route('posts.store'), $postData);
        $postId = $response->json('post.id');

        // Prepare update data
        $updateData = [
            'title' => 'Updated Title',
            'content' => 'New, Updated Content'
        ];

        // Perform update
        $updateResponse = $this->putJson(route('posts.update', $postId), $updateData);

        // Assertions
        $updateResponse->assertStatus(200)
            ->assertJson([
                'message' => true,
                'post' => [
                    'id' => $postId,
                    'title' => $updateData['title'],
                    'content' => $updateData['content']
                ]
            ]);
    }
}
