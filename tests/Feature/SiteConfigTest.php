<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class SiteConfigTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function siteconfigs_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('siteconfigs', [
            'id', "classroom_fee",
          ]), 1);
    }
}
