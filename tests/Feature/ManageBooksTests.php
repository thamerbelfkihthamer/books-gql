<?php

namespace Tests\Feature;

use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageBooksTests extends TestCase
{
    use RefreshDatabase;

    /**  @test */
    public function a_user_can_see_all_books()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function a_user_can_see_books_by_category_id()
    {

    }

    /** @test */
    public function a_user_can_see_books_by_featured_field()
    {

    }

    /** @test */
    public function a_user_can_create_new_book()
    {
        $book = factory(Book::class)->make();

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation createBook($title: String!, $author: String!, $image: String, $description: String, $featured: Boolean, $link: String, $category: Int!) {
                createBook(title: $title, author: $author, image: $image, description: $description, featured: $featured, link: $link, category: $category) {
                    title
                    id
                }
            }
        ', [
            'title' => $book->title,
            'author' => $book->author,
            'image' => $book->image,
            'description' => $book->description,
            'featured' => $book->featured,
            'category' => $book->category->id
        ]);

        $response->assertJson([
            'data' => [
                'createBook' => [
                    'title' => $book->title
                ]
            ]
        ]);
    }
}
