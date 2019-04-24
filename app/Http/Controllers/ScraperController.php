<?php

namespace App\Http\Controllers;

use App\Jobs\StoreVehicleCollection;
use App\Scraper\Scraper;
use Illuminate\Http\JsonResponse;

class ScraperController extends Controller
{

    /**
     * @param null $provider
     * @return JsonResponse
     * @throws \Exception
     */
    public function scrape($provider = null)
    {
        if($provider === null) throw new \Exception("A provider is required");

        /** @var Scraper $scraper */
        $scraper = app($provider);
        $vehicles = $scraper->scrape();

        $this->dispatchNow(new StoreVehicleCollection($vehicles));

        return JsonResponse::create($vehicles, 200);
    }
}
