<?php

namespace App\Decorators;

use Illuminate\Database\Eloquent\Collection;

abstract class RecommendationDecorator implements RecommendationInterface
{
    protected RecommendationInterface $recommendation;

    public function __construct(RecommendationInterface $recommendation)
    {
        $this->recommendation = $recommendation;
    }

    public function getRecommendations(): Collection
    {
        return $this->recommendation->getRecommendations();
    }

    public function getMetadata(): array
    {
        return $this->recommendation->getMetadata();
    }
}
