<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Builders\FoodItemBuilder;
use App\Services\RecommendationService;
use App\Strategies\MoodBasedStrategy;

class MoodFoodServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(FoodItemBuilder::class, function ($app) {
            return new FoodItemBuilder();
        });

        $this->app->bind(RecommendationService::class, function ($app) {
            return new RecommendationService(new MoodBasedStrategy());
        });
    }

    public function boot()
    {
        //
    }
}
