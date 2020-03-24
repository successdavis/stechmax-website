<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class businessTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->business = create('App\Business');
    }

    /** @test */
    public function business_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('businesses', [
            'id', "name", "image_path"
          ]), 1);
    }

    /** @test */
    public function it_generate_a_string_path()
    {
        $this->assertEquals("/business/{$this->business->slug}", $this->business->path());
    }


}
