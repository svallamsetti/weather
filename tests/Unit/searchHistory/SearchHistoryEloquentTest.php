<?php


namespace Tests\Unit\searchHistory;


use App\Models\SearchHistory;
use App\SearchHistoryRepository\SearchHistoryEloquent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class SearchHistoryEloquentTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCanCreateSearchHistory(): void
    {
        $knownDate = Carbon::create(2021, 1, 17, 12);
        Carbon::setTestNow($knownDate);
        $this->assertCount(0, SearchHistory::all());
        $searchHistoryEloquent = resolve(SearchHistoryEloquent::class);
        $searchHistoryEloquent->createRecords([
            'visitor' => '172.0.0.1',
            'location' => 'Mason',
            'temperature' =>'34.5',
            'zipCode' => '45040',
            'dayTime' =>'Sun, Jan 17, 4:50 PM',
            'created_at' => Carbon::now(),
        ]);
        $this->assertCount(1, SearchHistory::all());
        $this->assertSame(1, SearchHistory::first()->id);
        $this->assertSame('Mason', SearchHistory::first()->location);
        $this->assertSame('45040', SearchHistory::first()->zipCode);
        $this->assertSame('Sun, Jan 17, 4:50 PM', SearchHistory::first()->dayTime);
        $this->assertSame('2021-01-17 12:00:00', SearchHistory::first()->created_at);
    }

    public function testCanRetrieveSearchHistoryRecordsInDescOrder(): void
    {
        $searchHistoryEloquent = resolve(SearchHistoryEloquent::class);
        $this->assertCount(0, $searchHistoryEloquent->all());
        $searchHistoryEloquent->createRecords([
            'visitor' => '172.0.0.1',
            'location' => 'Mason',
            'temperature' =>'34.5',
            'zipCode' => '45040',
            'dayTime' =>'Sun, Jan 17, 4:50 PM',
            'created_at' => Carbon::now(),
        ]);
        $searchHistoryEloquent->createRecords([
            'visitor' => '172.0.0.1',
            'location' => 'Irvine',
            'temperature' =>'74.5',
            'zipCode' => '92602',
            'dayTime' =>'Sun, Jan 17, 4:50 PM',
            'created_at' => Carbon::now(),
        ]);
        $this->assertCount(2, $searchHistoryEloquent->all());
        $keys = $searchHistoryEloquent->all()->keys();
        $this->assertSame([1, 0], $keys->all());

    }
}
