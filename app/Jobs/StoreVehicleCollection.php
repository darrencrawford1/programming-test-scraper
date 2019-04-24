<?php

namespace App\Jobs;

use App\Scraper\StockCollection;
use App\Scraper\StockItem;
use App\Vehicle;

class StoreVehicleCollection extends Job
{
    /**
     * @var StockCollection
     */
    private $vehicles;

    /**
     * Create a new job instance.
     *
     * @param StockCollection $vehicles
     */
    public function __construct(StockCollection $vehicles)
    {
        $this->vehicles = $vehicles;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->vehicles->each(function($item) {
            /** @var StockItem $item */
            $vehicle = new Vehicle();
            $vehicle->manufacturer = $item->manufacturer;
            $vehicle->model = $item->derivative;
            $vehicle->derivative = $item->derivative;
            $vehicle->price = $item->price;
            $vehicle->transmission = $item->transmission;
            $vehicle->fuel = $item->fuelType;
            $vehicle->mileage = $item->mileage;
            $vehicle->save();
        });

    }
}
