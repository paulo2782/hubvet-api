<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name,
            'codebar' => $this->faker->numberBetween(0000000000000,9999999999999),
            'value' => $this->faker->randomFloat(1,20,200),
            'id_user' => $this->faker->randomDigit,
            'id_sector' => $this->faker->randomDigit,            
        ];
    }
}
