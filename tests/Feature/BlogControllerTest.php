<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\BaseApiTestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\BlogController
 */
class BlogControllerTest extends BaseApiTestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::index
     */
    public function it_can_index()
    {
        // Collect
        Blog::factory()->count(16)->create();

        // Act
        $response = $this->get(route('api.blogs.index'));

        // Assert
        $response->assertOk();
        $response->assertJsonCount(15, 'data');
        $response->assertSchemaCollection('blog.json');
    }

    /**
     * @test
     * @depends it_can_index
     * @covers ::index
     */
    public function it_can_index_and_sort_by_name()
    {
        // Collect
        $aBlog = Blog::factory()->create(['name' => 'A Blog']);
        $bBlog = Blog::factory()->create(['name' => 'B Blog']);

        // Act
        $responseAsc = $this->get(route('api.blogs.index', ['sort' => 'name']));
        $responseDsc = $this->get(route('api.blogs.index', ['sort' => '-name']));

        // Assert
        $this->assertSame(
            [$aBlog->id, $bBlog->id],
            Arr::pluck($responseAsc->json('data'), 'id')
        );
        $this->assertSame(
            [$bBlog->id, $aBlog->id],
            Arr::pluck($responseDsc->json('data'), 'id')
        );
    }

    /**
     * @test
     * @depends it_can_index
     * @covers ::index
     */
    public function it_can_index_and_include_user()
    {
        // Collect
        Blog::factory()->create();

        // Act
        $response = $this->get(route('api.blogs.index', ['include' => 'user']));

        // Assert
        $response->assertSchemaCollection('blog.json');
    }
}
