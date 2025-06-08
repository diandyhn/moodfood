<?php

namespace App\Decorators;

use Illuminate\Database\Eloquent\Collection;

class PrimaryRecommendationDecorator extends RecommendationDecorator
{
    public function getRecommendations(): Collection
    {
        $recommendations = parent::getRecommendations();
        
        if ($recommendations->isNotEmpty()) {
            $first = $recommendations->first();
            $first->setAttribute('is_primary', true);
            $first->setAttribute('primary_tag', 'Rekomendasi Utama');
        }

        return $recommendations;
    }

    public function getMetadata(): array
    {
        $metadata = parent::getMetadata();
        $metadata['has_primary'] = true;
        $metadata['primary_count'] = 1;

        return $metadata;
    }
}
