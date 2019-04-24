<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ScraperTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testScraper()
    {
        $this->expectsJobs(\App\Jobs\StoreVehicleCollection::class);

        $response = $this->get('/api/scraper/testprovider/scrape');

        $response
            ->seeJson([
                "manufacturer" => "AUDI",
                "model" => "A4",
                "fuelType" => "Petrol",
                "transmission" => "Manual",
                "derivative" => "TDi",
                "price" => 8999,
            ])
            ->assertResponseStatus(200);
    }
}
