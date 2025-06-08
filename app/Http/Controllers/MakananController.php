<?php

namespace App\Http\Controllers;

use App\Builders\FoodItemBuilder;
use App\Models\FoodItem;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    private FoodItemBuilder $builder;

    public function __construct(FoodItemBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function index()
    {
        $foodItems = FoodItem::paginate(10);
        return view('makanan.index', compact('foodItems'));
    }

    public function create()
    {
        return view('makanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'calories' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'mood_tags' => 'required|array',
            'ingredients' => 'required|array',
            'gofood_link' => 'nullable|url',
            'image_url' => 'nullable|url',
            'is_healthy' => 'boolean',
            'spicy_level' => 'integer|min:0|max:5',
            'preparation_time' => 'integer|min:0'
        ]);

        $foodItem = $this->builder
            ->setName($validated['name'])
            ->setDescription($validated['description'])
            ->setCalories($validated['calories'])
            ->setPrice($validated['price'])
            ->setCategory($validated['category'])
            ->setMoodTags($validated['mood_tags'])
            ->setIngredients($validated['ingredients'])
            ->setGoFoodLink($validated['gofood_link'] ?? '')
            ->setImageUrl($validated['image_url'] ?? '')
            ->setHealthyOption($validated['is_healthy'] ?? false)
            ->setSpicyLevel($validated['spicy_level'] ?? 0)
            ->setPreparationTime($validated['preparation_time'] ?? 0)
            ->build();

        $foodItem->save();

        return redirect()->route('makanan.index')->with('success', 'Makanan berhasil ditambahkan!');
    }

    public function show(FoodItem $makanan)
    {
        return view('makanan.show', compact('makanan'));
    }

    public function edit(FoodItem $makanan)
    {
        return view('makanan.edit', compact('makanan'));
    }

    public function update(Request $request, FoodItem $makanan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'calories' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'mood_tags' => 'required|array',
            'ingredients' => 'required|array',
            'gofood_link' => 'nullable|url',
            'image_url' => 'nullable|url',
            'is_healthy' => 'boolean',
            'spicy_level' => 'integer|min:0|max:5',
            'preparation_time' => 'integer|min:0'
        ]);

        $updatedFoodItem = $this->builder
            ->setName($validated['name'])
            ->setDescription($validated['description'])
            ->setCalories($validated['calories'])
            ->setPrice($validated['price'])
            ->setCategory($validated['category'])
            ->setMoodTags($validated['mood_tags'])
            ->setIngredients($validated['ingredients'])
            ->setGoFoodLink($validated['gofood_link'] ?? '')
            ->setImageUrl($validated['image_url'] ?? '')
            ->setHealthyOption($validated['is_healthy'] ?? false)
            ->setSpicyLevel($validated['spicy_level'] ?? 0)
            ->setPreparationTime($validated['preparation_time'] ?? 0)
            ->build();

        $makanan->update($updatedFoodItem->toArray());

        return redirect()->route('makanan.index')->with('success', 'Makanan berhasil diupdate!');
    }

    public function destroy(FoodItem $makanan)
    {
        $makanan->delete();
        return redirect()->route('makanan.index')->with('success', 'Makanan berhasil dihapus!');
    }
}
