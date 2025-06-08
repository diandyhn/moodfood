<?php

namespace App\Http\Controllers;

use App\Services\RecommendationService;
use App\Factories\RecommendationStrategyFactory;
use App\Decorators\BaseRecommendation;
use App\Decorators\PrimaryRecommendationDecorator;
use App\Decorators\LowCalorieDecorator;
use App\Decorators\BudgetFriendlyDecorator;
use App\Decorators\SpicyAlertDecorator;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function index(Request $request)
    {
        $mood = $request->input('mood', 'happy');
        $strategyType = $request->input('strategy', 'mood');
        $decorators = $request->input('decorators', []);

        $strategy = RecommendationStrategyFactory::create($strategyType);
        $service = new RecommendationService($strategy);
        $recommendations = $service->getRecommendations($mood, $request->all());

        $decorated = new BaseRecommendation($recommendations);
        $decorated = new PrimaryRecommendationDecorator($decorated);

        if (in_array('low_calorie', $decorators)) {
            $decorated = new LowCalorieDecorator($decorated, 300);
        }

        if (in_array('budget_friendly', $decorators)) {
            $decorated = new BudgetFriendlyDecorator($decorated, 25000);
        }

        if (in_array('spicy_alert', $decorators)) {
            $decorated = new SpicyAlertDecorator($decorated, 3);
        }

        return view('rekomendasi.index', [
            'recommendations' => $decorated->getRecommendations(),
            'metadata' => $decorated->getMetadata(),
            'mood' => $mood,
            'strategy' => $strategyType
        ]);
    }

    public function byMood($mood)
    {
        $strategy = RecommendationStrategyFactory::create('mood');
        $service = new RecommendationService($strategy);
        $recommendations = $service->getRecommendations($mood);

        return view('rekomendasi.by-mood', compact('recommendations', 'mood'));
    }

    public function healthy(Request $request)
    {
        $mood = $request->input('mood', 'happy');
        $calorieLimit = $request->input('calorie_limit', 400);

        $strategy = RecommendationStrategyFactory::create('health');
        $service = new RecommendationService($strategy);
        $recommendations = $service->getRecommendations($mood, ['calorie_limit' => $calorieLimit]);

        $decorated = new BaseRecommendation($recommendations);
        $decorated = new LowCalorieDecorator($decorated, $calorieLimit);
        $decorated = new PrimaryRecommendationDecorator($decorated);

        return view('rekomendasi.healthy', [
            'recommendations' => $decorated->getRecommendations(),
            'metadata' => $decorated->getMetadata(),
            'mood' => $mood
        ]);
    }

    public function budget($maxPrice)
    {
        $strategy = RecommendationStrategyFactory::create('budget');
        $service = new RecommendationService($strategy);
        $recommendations = $service->getRecommendations('happy', ['max_price' => $maxPrice]);

        $decorated = new BaseRecommendation($recommendations);
        $decorated = new BudgetFriendlyDecorator($decorated, $maxPrice);
        $decorated = new PrimaryRecommendationDecorator($decorated);

        return view('rekomendasi.budget', [
            'recommendations' => $decorated->getRecommendations(),
            'metadata' => $decorated->getMetadata(),
            'maxPrice' => $maxPrice
        ]);
    }

    public function getRecommendations(Request $request)
    {
        $mood = $request->input('mood', 'happy');
        $strategy = $request->input('strategy', 'mood');
        $preferences = $request->input('preferences', []);

        $strategyInstance = RecommendationStrategyFactory::create($strategy);
        $service = new RecommendationService($strategyInstance);
        $recommendations = $service->getRecommendations($mood, $preferences);

        return response()->json([
            'success' => true,
            'data' => $recommendations,
            'count' => $recommendations->count()
        ]);
    }
}
