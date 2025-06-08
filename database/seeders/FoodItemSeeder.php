<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Builders\FoodItemBuilder;

class FoodItemSeeder extends Seeder
{
    public function run()
    {
        $builder = new FoodItemBuilder();

        $happyFoods = [
            [
                'name' => 'Nasi Gudeg Yogya',
                'description' => 'Gudeg khas Yogyakarta dengan kuah santan yang gurih',
                'calories' => 450,
                'price' => 25000,
                'category' => 'Traditional',
                'mood_tags' => ['happy', 'comfort', 'traditional'],
                'ingredients' => ['nangka muda', 'santan', 'bumbu rempah', 'ayam'],
                'gofood_link' => 'https://gofood.co.id/gudeg-yogya',
                'image_url' => 'https://example.com/gudeg.jpg',
                'is_healthy' => false,
                'spicy_level' => 1,
                'preparation_time' => 45
            ],
            [
                'name' => 'Smoothie Bowl Acai',
                'description' => 'Smoothie bowl sehat dengan buah-buahan segar',
                'calories' => 280,
                'price' => 35000,
                'category' => 'Healthy',
                'mood_tags' => ['happy', 'energetic', 'fresh'],
                'ingredients' => ['acai berry', 'pisang', 'granola', 'madu'],
                'gofood_link' => 'https://gofood.co.id/smoothie-bowl',
                'image_url' => 'https://example.com/smoothie.jpg',
                'is_healthy' => true,
                'spicy_level' => 0,
                'preparation_time' => 10
            ]
        ];

        $sadFoods = [
            [
                'name' => 'Chocolate Lava Cake',
                'description' => 'Kue coklat hangat dengan lelehan coklat di tengah',
                'calories' => 520,
                'price' => 45000,
                'category' => 'Dessert',
                'mood_tags' => ['sad', 'comfort', 'sweet'],
                'ingredients' => ['coklat dark', 'butter', 'telur', 'gula'],
                'gofood_link' => 'https://gofood.co.id/lava-cake',
                'image_url' => 'https://example.com/lava-cake.jpg',
                'is_healthy' => false,
                'spicy_level' => 0,
                'preparation_time' => 25
            ],
            [
                'name' => 'Sup Ayam Jahe',
                'description' => 'Sup ayam hangat dengan jahe untuk menghangatkan badan',
                'calories' => 180,
                'price' => 20000,
                'category' => 'Soup',
                'mood_tags' => ['sad', 'comfort', 'warm'],
                'ingredients' => ['ayam', 'jahe', 'wortel', 'seledri'],
                'gofood_link' => 'https://gofood.co.id/sup-ayam',
                'image_url' => 'https://example.com/sup-ayam.jpg',
                'is_healthy' => true,
                'spicy_level' => 1,
                'preparation_time' => 30
            ]
        ];

        $energeticFoods = [
            [
                'name' => 'Spicy Korean Ramen',
                'description' => 'Ramen Korea pedas dengan telur dan sayuran',
                'calories' => 650,
                'price' => 32000,
                'category' => 'Asian',
                'mood_tags' => ['energetic', 'spicy', 'bold'],
                'ingredients' => ['mie ramen', 'kimchi', 'telur', 'cabai'],
                'gofood_link' => 'https://gofood.co.id/korean-ramen',
                'image_url' => 'https://example.com/ramen.jpg',
                'is_healthy' => false,
                'spicy_level' => 4,
                'preparation_time' => 15
            ],
            [
                'name' => 'Protein Power Bowl',
                'description' => 'Bowl penuh protein dengan quinoa, ayam, dan sayuran',
                'calories' => 420,
                'price' => 38000,
                'category' => 'Healthy',
                'mood_tags' => ['energetic', 'healthy', 'protein'],
                'ingredients' => ['quinoa', 'ayam grilled', 'brokoli', 'avocado'],
                'gofood_link' => 'https://gofood.co.id/protein-bowl',
                'image_url' => 'https://example.com/protein-bowl.jpg',
                'is_healthy' => true,
                'spicy_level' => 0,
                'preparation_time' => 20
            ]
        ];

        foreach (array_merge($happyFoods, $sadFoods, $energeticFoods) as $foodData) {
            $builder
                ->setName($foodData['name'])
                ->setDescription($foodData['description'])
                ->setCalories($foodData['calories'])
                ->setPrice($foodData['price'])
                ->setCategory($foodData['category'])
                ->setMoodTags($foodData['mood_tags'])
                ->setIngredients($foodData['ingredients'])
                ->setGoFoodLink($foodData['gofood_link'])
                ->setImageUrl($foodData['image_url'])
                ->setHealthyOption($foodData['is_healthy'])
                ->setSpicyLevel($foodData['spicy_level'])
                ->setPreparationTime($foodData['preparation_time'])
                ->build()
                ->save();
        }
    }
}
