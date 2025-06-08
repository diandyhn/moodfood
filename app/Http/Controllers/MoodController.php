<?php

namespace App\Http\Controllers;

use App\Builders\FoodItemBuilder;
use App\Services\RecommendationService;
use App\Factories\RecommendationStrategyFactory;
use App\Decorators\BaseRecommendation;
use App\Decorators\PrimaryRecommendationDecorator;
use App\Decorators\LowCalorieDecorator;
use App\Decorators\BudgetFriendlyDecorator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoodController extends Controller
{
    public function index()
    {
        return view('mood.index');
    }

    public function detectMood(Request $request)
    {
        $mood = $request->input('mood', 'happy');
        $preferences = $request->input('preferences', []);
        $strategyType = $request->input('strategy', 'mood');

        $strategy = RecommendationStrategyFactory::create($strategyType);
        $recommendationService = new RecommendationService($strategy);
        $recommendations = $recommendationService->getRecommendations($mood, $preferences);

        $baseRecommendation = new BaseRecommendation($recommendations);
        $decoratedRecommendation = new PrimaryRecommendationDecorator($baseRecommendation);

        if (isset($preferences['health_conscious']) && $preferences['health_conscious']) {
            $decoratedRecommendation = new LowCalorieDecorator($decoratedRecommendation);
        }

        if (isset($preferences['budget_conscious']) && $preferences['budget_conscious']) {
            $decoratedRecommendation = new BudgetFriendlyDecorator($decoratedRecommendation);
        }

        $finalRecommendations = $decoratedRecommendation->getRecommendations();
        $metadata = $decoratedRecommendation->getMetadata();

        return response()->json([
            'mood' => $mood,
            'strategy' => $strategyType,
            'recommendations' => $finalRecommendations,
            'metadata' => $metadata,
            'total' => $finalRecommendations->count()
        ]);
    }

    public function showRecommendations($mood)
    {
        $strategy = RecommendationStrategyFactory::create('mood');
        $recommendationService = new RecommendationService($strategy);
        $recommendations = $recommendationService->getRecommendations($mood);

        return view('mood.recommendations', compact('mood', 'recommendations'));
    }
}
