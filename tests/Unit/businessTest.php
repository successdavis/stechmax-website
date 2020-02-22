<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class businessTest extends TestCase
{
    use DatabaseMigrations;


    /** @test */
    public function business_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('businesses', [
            'id', "name", "image_path"
          ]), 1);
    }

}
