<?php

namespace App\SearchHistoryRepository;

interface SearchHistoryContract{
    public function all();
    public function createRecords(array $attributes);
}
