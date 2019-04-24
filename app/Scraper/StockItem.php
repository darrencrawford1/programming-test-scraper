<?php

namespace App\Scraper;

class StockItem
{
    public $manufacturer;
    public $model;
    public $derivative;

    public $mileage;
    public $transmission;
    public $fuelType;
    public $price;

    public function __construct($manufacturer, $model, $mileage, $transmission, $fuelType, $price, $derivative = null)
    {
        $this->manufacturer = $manufacturer;
        $this->model = $model;
        $this->mileage = $mileage;
        $this->transmission = $transmission;
        $this->fuelType = $fuelType;
        $this->price = $price;
        $this->derivative = $derivative;
    }
}
