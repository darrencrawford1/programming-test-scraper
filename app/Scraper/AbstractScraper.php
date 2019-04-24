<?php

namespace App\Scraper;

use PHPHtmlParser\Dom;

abstract class AbstractScraper
{
    /**
     * The scraper instance (https://github.com/paquettg/php-html-parser)
     * @var Dom
     */
    protected $dom;

    /**
     * BaseScraper constructor.
     * @param Dom $dom
     */
    public function __construct(Dom $dom)
    {
        $this->dom = $dom;
    }
}
