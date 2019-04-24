<?php

namespace App\Scraper\Providers;

use App\Scraper\AbstractScraper;
use App\Scraper\Scraper;
use App\Scraper\StockCollection;
use App\Scraper\StockItem;
use PHPHtmlParser\Dom;
use stringEncode\Exception;

class BeechlawnMotors extends AbstractScraper implements Scraper
{
    /**
     * The base URL for the site
     *
     * @var string
     */
    protected $baseUrl = "https://www.beechlawnmotors.co.uk";

    /**
     * The Urls where the stock listing begins on the site.
     *
     * @var string
     */
    protected $stockUrl = "https://www.beechlawnmotors.co.uk/used-cars";

    /**
     * The total pages we need to scrape on this site. It defaults to 1.
     *
     * @var string
     */
    protected $totalPages = 1;

    protected $data;


    /**
     * @return StockCollection
     * @throws Exception
     */
    public function scrape()
    {
        $this->data = $this->dom->loadFromUrl($this->stockUrl);
        $this->setTotalPages();

        $stockItemCollection = new StockCollection();

        for ($i=1; $i<$this->totalPages; $i++) {
            $stockItemCollection = $this->getStockItems()->merge($stockItemCollection->toArray());
            $this->data = $this->dom->loadFromUrl($this->stockUrl . "?page=" . ($i));
        }

        return $stockItemCollection;
    }

    /**
     * Find the appropriate 'last' pagination element and set the total pages.
     *
     * @return void
     */
    private function setTotalPages()
    {
        $lastPageAnchor = $this->data->find('.pagination--last a');

        if(count($lastPageAnchor)) {
            $queryParams = explode("?", $lastPageAnchor[0]->href);
            parse_str(array_pop($queryParams), $result);

            $this->totalPages = (integer) $result['page'];
        }
    }

    /**
     * @return StockCollection
     * @throws Exception
     */
    private function getStockItems()
    {
        $stockItems = $this->data->find(".stock-items .stocklistAdvert");

        if(!count($stockItems)) throw new Exception("Stock items could not be found.");

        $stockItemCollection = new StockCollection();

        foreach ($stockItems as $item) {
            $fullListingUrl = $item->find(".permalink");
            if(!count($fullListingUrl)) throw new Exception("Full listing URL not found");

            $stockItemData = $this->dom->loadFromUrl($this->baseUrl . $fullListingUrl[0]->href, [
                'removeScripts' => false
            ]);

            $stockItem = $this->parseStockItem($stockItemData);
            $stockItemCollection[] = $stockItem;

        }

        return $stockItemCollection;
    }

    /**
     * @param Dom $stockItemData
     * @return StockItem
     */
    private function parseStockItem(\PHPHtmlParser\Dom $stockItemData)
    {
        $stockItem = new StockItem(
            $stockItemData->find(".qa-hidden-vehicle-data li.make")[0]->text,
            $stockItemData->find(".qa-hidden-vehicle-data li.model")[0]->text,
            $stockItemData->find(".qa-hidden-vehicle-data li.vehicleMileage")[0]->text,
            $stockItemData->find(".s-gearbox .js-summary-content b")[0]->text,
            $stockItemData->find(".s-fueltype .js-summary-content b")[0]->text,
            $this->formatPrice($stockItemData->find(".qa-hidden-vehicle-data li.price")[0]->text),
            $this->findDerivative($stockItemData)
        );

        return $stockItem;
    }

    /**
     * @param $priceData
     * @return int
     */
    private function formatPrice($priceData)
    {
        return intval($priceData);
    }

    /**
     * @param Dom $stockItemData
     * @return mixed
     */
    private function findDerivative(Dom $stockItemData)
    {
        preg_match("/derivative: '([\.\wa-zA-Z0-9\s]+)'/", (string) $stockItemData, $matches);

        return array_pop($matches);
    }
}
