<?php

namespace Tests\Unit\Models;

use Tests\TestCase;

use App\Models\Category;
use App\Models\Genre;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    private $category;

    protected function setUp():void
    {
        parent::setUp();
        $this->category = new Category();
    }

    public function testFillableAttribute()
    {
        $fillable = ["name", "description", "is_active"];
        $this->assertEquals($fillable,$this->category->getFillable());
    }

    public function testDatesAttribute()
    {
        
        $dates = ["deleted_at", "created_at", "updated_at"];
        foreach($dates as $date):
            $this->assertContains($date, $this->category->getDates());
        endforeach;
        $this->assertCount(count($dates), $this->category->getDates());
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
        $casts = ["id"=>"string"];
        $this->assertEquals($casts, $this->category->getCasts());
    }

    public function testIncrementing()
    {
        $this->assertFalse($this->category->incrementing);
    }

}

