<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PetMDBuletin
{
    private $ua = [];

    private $url = 'https://www.petmd.com/petmd/api/view?id=view.search_results_improved.page_1&page=0&keys=cat&fields=author,excerpt,image';

    private $perPage = 24;
    private $totalItems = 2279;

    public function __construct()
    {
        $desktopUserAgents = '[{"ua": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.10 Safari/605.1.1", "pct": 43.03}, {"ua": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.3", "pct": 21.05}, {"ua": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.3", "pct": 17.34}, {"ua": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.3", "pct": 3.72}, {"ua": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Trailer/93.3.8652.5", "pct": 2.48}, {"ua": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.", "pct": 2.48}, {"ua": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.", "pct": 2.48}, {"ua": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.", "pct": 2.48}, {"ua": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.", "pct": 1.24}, {"ua": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.1958", "pct": 1.24}, {"ua": "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.", "pct": 1.24}, {"ua": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.3", "pct": 1.24}]';
        $mobileUserAgents = '[{"ua": "Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.3", "pct": 63.11}, {"ua": "Mozilla/5.0 (iPhone; CPU iPhone OS 18_3_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3.1 Mobile/15E148 Safari/604.", "pct": 8.25}, {"ua": "Mozilla/5.0 (iPhone; CPU iPhone OS 18_3_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/360.1.737798518 Mobile/15E148 Safari/604.", "pct": 5.83}, {"ua": "Mozilla/5.0 (iPhone; CPU iPhone OS 18_3_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/134.0.6998.99 Mobile/15E148 Safari/604.", "pct": 4.85}, {"ua": "Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/27.0 Chrome/125.0.0.0 Mobile Safari/537.3", "pct": 3.88}, {"ua": "Mozilla/5.0 (iPhone; CPU iPhone OS 17_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.5 Mobile/15E148 Safari/604.", "pct": 3.4}, {"ua": "Mozilla/5.0 (iPhone; CPU iPhone OS 18_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3 Mobile/15E148 Safari/604.", "pct": 1.94}, {"ua": "Mozilla/5.0 (iPhone; CPU iPhone OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Mobile/15E148 Safari/604.", "pct": 1.94}, {"ua": "Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Mobile Safari/537.3", "pct": 1.46}, {"ua": "Mozilla/5.0 (Android 14; Mobile; rv:136.0) Gecko/136.0 Firefox/136.", "pct": 0.97}, {"ua": "Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.3", "pct": 0.97}, {"ua": "Mozilla/5.0 (Linux; Android 10; JNY-LX1; HMSCore 6.15.0.302) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.5735.196 HuaweiBrowser/15.0.4.312 Mobile Safari/537.3", "pct": 0.97}, {"ua": "Mozilla/5.0 (Android 15; Mobile; rv:136.0) Gecko/136.0 Firefox/136.", "pct": 0.49}, {"ua": "Mozilla/5.0 (iPhone; CPU iPhone OS 10_3 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) CriOS/56.0.2924.75 Mobile/14E5239e YisouSpider/5.0 Safari/602.", "pct": 0.49}, {"ua": "Mozilla/5.0 (iPhone; CPU iPhone OS 16_7_10 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.", "pct": 0.49}, {"ua": "Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Mobile Safari/537.3", "pct": 0.49}, {"ua": "Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.3", "pct": 0.49}]';

        $desktopUserAgents = json_decode($desktopUserAgents, true);
        $mobileUserAgents = json_decode($mobileUserAgents, true);

        $this->ua = array_merge($desktopUserAgents, $mobileUserAgents);
    }

    public function random()
    {
        $uaIndex = rand(0, count($this->ua) - 1);
        $uaString = $this->ua[$uaIndex]['ua'];

        $minPage = 0;
        $maxPage = intval(ceil($this->totalItems / $this->perPage) - 1);
        $rndPage = rand($minPage, $maxPage);

        $url = str_replace('page=0', 'page=' . $rndPage, $this->url);

        $request = Http::withHeader('User-Agent', $uaString)->get($url);
        if (!$request->successful()) {
            $request->close();
            return [];
        }

        $results = $request->json();
        $request->close();

        return $results;
    }
}
