<?php

namespace Tests\Unit\app\Models;

use App\Models\Book;
use App\Models\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCategoryName()
    {
        $book = new Book();
        $this->assertNotEmpty($book->getCategoryName());
    }
}
