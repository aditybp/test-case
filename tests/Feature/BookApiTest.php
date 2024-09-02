<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_retrieve_all_books()
    {
        Book::factory(3)->create();

        $response = $this->getJson('/books');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_can_retrieve_single_book()
    {
        $book = Book::factory()->create();

        $response = $this->getJson("/books/{$book->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author,
            'published_year' => $book->published_year,
        ]);
    }

    public function test_can_create_a_book()
    {
        $response = $this->postJson('/books', [
            'title' => 'New Book',
            'author' => 'New Author',
            'published_year' => 2024,
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'title' => 'New Book',
            'author' => 'New Author',
            'published_year' => 2024,
        ]);

        $this->assertDatabaseHas('books', ['title' => 'New Book']);
    }

    public function test_can_update_a_book()
    {
        $book = Book::factory()->create();

        $response = $this->putJson("/books/{$book->id}", [
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'published_year' => 2023,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'published_year' => 2023,
        ]);

        $this->assertDatabaseHas('books', ['title' => 'Updated Title']);
    }

    public function test_can_delete_a_book()
    {
        $book = Book::factory()->create();

        $response = $this->deleteJson("/books/{$book->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['message' => 'Book Deleted']);
        
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    public function test_cannot_retrieve_non_existent_book()
    {
        $response = $this->getJson('/books/999');

        $response->assertStatus(404);
    }
}

