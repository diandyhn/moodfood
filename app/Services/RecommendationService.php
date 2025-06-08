<?php

namespace App\Services;

class RecommendationService
{
    protected $strategy;

    public function __construct($strategy)
    {
        $this->strategy = $strategy;
    }

    public function getRecommendations($criteria = [])
{
    if (is_array($criteria)) {
        return $this->strategy->recommend(...array_values($criteria));
    } else {
        // jika string langsung dipakai sebagai parameter pertama, preferences kosong
        return $this->strategy->recommend($criteria, []);
    }
}


}
