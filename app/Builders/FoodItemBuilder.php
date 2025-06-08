<?php

namespace App\Builders;

use App\Models\FoodItem;

/**
 * Builder Pattern untuk membuat objek FoodItem yang kompleks
 * File: app/Builders/FoodItemBuilder.php
 */
class FoodItemBuilder
{
    private $foodItem;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): self
    {
        $this->foodItem = new FoodItem();
        return $this;
    }

    public function setName(string $name): self
    {
        $this->foodItem->name = $name;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->foodItem->description = $description;
        return $this;
    }

    public function setCalories(int $calories): self
    {
        $this->foodItem->calories = $calories;
        return $this;
    }

    public function setPrice(float $price): self
    {
        $this->foodItem->price = $price;
        return $this;
    }

    public function setCategory(string $category): self
    {
        $this->foodItem->category = $category;
        return $this;
    }

    public function setMoodTags(array $moodTags): self
    {
        $this->foodItem->mood_tags = json_encode($moodTags);
        return $this;
    }

    public function setIngredients(array $ingredients): self
    {
        $this->foodItem->ingredients = json_encode($ingredients);
        return $this;
    }

    public function setGoFoodLink(string $link): self
    {
        $this->foodItem->gofood_link = $link;
        return $this;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->foodItem->image_url = $imageUrl;
        return $this;
    }

    public function setHealthyOption(bool $isHealthy): self
    {
        $this->foodItem->is_healthy = $isHealthy;
        return $this;
    }

    public function setSpicyLevel(int $level): self
    {
        $this->foodItem->spicy_level = $level;
        return $this;
    }

    public function setPreparationTime(int $minutes): self
    {
        $this->foodItem->preparation_time = $minutes;
        return $this;
    }

    public function build(): FoodItem
    {
        $result = $this->foodItem;
        $this->reset(); // Reset untuk instance berikutnya
        return $result;
    }
}