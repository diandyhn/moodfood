<?php

namespace App\Decorators;

use Illuminate\Database\Eloquent\Collection;

interface RecommendationInterface
{
    public function getRecommendations(): Collection;
    public function getMetadata(): array;
}
