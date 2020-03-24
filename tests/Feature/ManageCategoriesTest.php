<?php

namespace Tests\Feature;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_categories()
    {
        $category = factory(Category::class)->create();

        $this->graphQL(
        /** @lang GraphQl */
            '
        {
            categories {
                id
                name
            }
        }
        ')->assertJson([
            'data' => [
                'categories' => [
                    [
                        'id' => $category->id,
                        'name' => $category->name
                    ]
                ]
            ]
        ]);
    }

    /** @test */
    public function a_user_can_view_one_category()
    {
        $category = factory(Category::class)->create();

        $response = $this->graphQL(
        /** @lang GraphQl */
            '
        {
           category(id: 1) {
                id
                name
           }
        }
        ');

        $response->assertSee($category->name);
    }

    /** @test */
    public function a_user_receive_empty_category_when_category_id_not_valide()
    {
        $category = factory(Category::class)->create();

        $response = $this->graphQL(
        /** @lang GraphQl */
            '
        {
           category(id: 10) {
                id
                name
           }
        }
        ');

        $response->assertDontSeeText($category->name);
    }

    /** @test */
    public function a_user_can_create_a_new_category()
    {
        $category = factory(Category::class)->make();

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation createCategory($name: String) {
                createCategory(name: $name) {
                    name
                }
            }
        ', [
                'name' => $category->name
            ]);

        $response->assertJson([
            'data' => [
                'createCategory' => [
                    'name' => $category->name
                ]
            ]
        ]);
    }

    /** @test */
    public function a_user_cannot_create_category_with_the_same_name_twice()
    {
        $category = factory(Category::class)->create();

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation createCategory($name: String) {
                createCategory(name: $name) {
                    name
                }
            }
        ', [
            'name' => $category->name
        ]);

        $response->assertSee("The name has already been taken.");
    }

    /** @test */
    public function it_validate_category_name()
    {
        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation createCategory($name: String) {
                createCategory(name: $name) {
                    name
                }
            }
        ', [
            'name' => ""
        ]);

       $response->assertSee("The name field is required.");

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation createCategory($name: String) {
                createCategory(name: $name) {
                    name
                }
            }
        ', [
            'name' => "fd"
        ]);

       $response->assertSee("The name must be at least 4 characters.");
    }

    /** @test */
    public function  a_user_can_update_a_category()
    {
        $category = factory(Category::class)->create();

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation updateCategory($id: ID!, $name: String) {
                updateCategory(id: $id, name: $name) {
                    name
                }
            }
        ', [
            'id' => $category->id,
            'name' => "category"
        ]);

        $response->assertSee("category");
        $this->assertDatabaseHas('categories',
            ['name' => "category", 'id' => $category->id]
        );
    }

    /** @test */
    public function a_user_can_delete_category()
    {
        $category = factory(Category::class)->create();

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation deleteCategory($id: ID!) {
                deleteCategory(id: $id) {
                    name
                }
            }
        ', [
            'id' => $category->id,
        ]);

        $this->assertDatabaseMissing(
            'categories',
            ['id' => $category->id]
        );
    }
}
