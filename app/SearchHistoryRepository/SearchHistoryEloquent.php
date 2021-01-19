<?php


namespace App\SearchHistoryRepository;


use App\Models\SearchHistory;
use Illuminate\Database\Eloquent\Collection;

class SearchHistoryEloquent implements SearchHistoryContract
{
    /**
     * @var SearchHistory
     */
    private $searchHistory;

    /**
     * SearchHistoryEloquent constructor.
     * @param SearchHistory $searchHistory
     */
    public function __construct(SearchHistory  $searchHistory)
    {
        $this->searchHistory = $searchHistory;
    }

    public function all(): Collection
    {
        return $this->searchHistory->all()->sortKeysDesc();
    }


    public function createRecords(array $attributes)
    {
        return $this->searchHistory->create($attributes);
    }
}
