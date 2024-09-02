<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_requires_title_author_and_published_year()
    {
        $response = $this->postJson('/books', [
            'title' => '',
            'author' => '',
            'published_year' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title', 'author', 'published_year']);
    }

    public function test_store_validates_published_year()
    {
        $response = $this->postJson('/books', [
            'title' => 'Test Title',
            'author' => 'Test Author',
            'published_year' => 'not_a_year',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['published_year']);
    }

    public function test_update_validates_title_author_and_published_year()
    {
        $book = Book::factory()->create();

        $response = $this->putJson("/books/{$book->id}", [
            'title' => '',
            'author' => '',
            'published_year' => 'abcd',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title', 'author', 'published_year']);
    }
}

