<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PetMDBuletin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BuletinController extends Controller
{
    public function index(Request $request)
    {
        $buletin = Cache::remember('buletin_index', now()->addDay(1), function () {
            return $this->getBuletin();
        });

        if (empty($buletin) || $request->query('refresh') === 'force') {
            Cache::forget('buletin_index');
            $buletin = Cache::remember('buletin_index', now()->addDay(1), function () {
                return $this->getBuletin();
            });
        }

        return $buletin;
    }

    private function getBuletin()
    {
        try {
            $buletin = new PetMDBuletin()->random();
            $article = collect($buletin['result'])->where('type', 'article');

            $results = [];

            foreach ($article as $row) {
                $link = 'https://www.petmd.com' . $row['url'];
                $results [] = [
                    'title' => $row['title'],
                    'date' => $row['changed'],
                    'excerpt' => $row['excerpt'],
                    'author' => $row['author']['name'],
                    'link' => $link,
                ];
            }


            return $results;
        } catch (\Throwable $th) {
            return [];
        }
    }
}
