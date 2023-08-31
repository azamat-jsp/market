<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Tbuy\Product\Models\Product;
use App\Tbuy\Search\Model\SearchKeyWord;
use App\Tbuy\Search\Services\SearchableModelService;
use App\Tbuy\Search\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(
        private readonly SearchService $searchService
    )
    {
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $mistake = "";


        if (strlen($search) > 3) {
            $len = (int) (round(strlen($search) / 2) - round(strlen($search) / 4));

            $start = substr($search, 0, $len);
            $end = substr($search, strlen($search) - $len, $len);

            $mistake = SearchKeyWord::query()
                ->where(
                    'name',
                    'like',
                    "$start%$end"
                )->first()?->name ?? "";
        }

        return [
            'mistake' => $mistake,
            'searchWords' => SearchKeyWord::query()
                ->where('name', 'like', "$search%")
                ->limit(5)
                ->get('name')
                ->map(fn(SearchKeyWord $word) => $word->name)
                ->all(),
            ...$this->searchService->search($search)
        ];
    }
}
