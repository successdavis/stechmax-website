<?php

namespace Tests\Feature;

use App\Business;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class PricingTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->business = create('App\Business');
        $this->pricing = create('App\Pricing');
    }

        /** @test */
    public function pricing_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('pricings', [
            'id', "description", "price", "business_id"
          ]), 1);
    }

    /** @test */
    public function it_belongs_to_a_business()
    {
        $this->assertInstanceOf('App\Business', $this->pricing->business);
    }
}
