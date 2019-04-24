<?php

namespace App\Scraper;

interface Scraper
{
    /**
     * @return StockCollection
     */
    public function scrape();
}
