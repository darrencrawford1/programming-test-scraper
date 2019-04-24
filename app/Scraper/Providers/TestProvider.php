<?php

namespace App\Scraper\Providers;

use App\Scraper\AbstractScraper;
use App\Scraper\Scraper;
use App\Scraper\StockCollection;
use App\Scraper\StockItem;
use PHPHtmlParser\Dom;
use stringEncode\Exception;

class TestProvider extends AbstractScraper implements Scraper
{
    /**
     * Test Provider mocks a JSON response for PHPUnit Testing.
     * This is so we don't waste resources scraping a website each time the tests
     * are run.
     *
     * @return StockCollection
     */
    public function scrape()
    {
        return new StockCollection([
            new StockItem(
                "AUDI",
                "A4",
                100000,
                "Manual",
                "Petrol",
                8999,
                "TDi"
            )
        ]);
    }
}
