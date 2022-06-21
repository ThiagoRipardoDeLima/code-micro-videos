<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Models\Category;
use App\Models\Genre;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function testFillableAttribute()
    {
        $category = new Category();
        $fillable = ["name", "description", "is_active"];
        $this->assertEquals($fillable,$category->getFillable());
    }

    public function testDatesAttribute()
    {
        $category = new Category();
        $dates = ["deleted_at", "created_at", "updated_at"];
        foreach($dates as $date):
            $this->assertContains($date, $category->getDates());
        endforeach;
        $this->assertCount(count($dates), $category->getDates());
    }

    public function testIfUseTrait()
    {
        $traits = [
            SoftDeletes::class, Uuid::class
        ];

        $categoryTraits = array_keys(class_uses(Category::class));
        $this->assertEquals($traits, $categoryTraits);
    }

    public function testCasts()
    {
        $category = new Category();
        $casts = ["id"=>"string"];
        $this->assertEquals($casts, $category->getCasts());
    }

    public function testIncrementing()
    {
        $category = new Category();
        $this->assertFalse($category->incrementing);
    }

}

