<?php

namespace Database\Factories;

use App\Enums\UrlStates;
use App\Models\Url;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Url>
 */
class UrlFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Url::class;

    /**
     * Define the modclearel's default state.
     */
    public function definition(): array
    {
        return [
            'destination' => $this->faker->url(),
            'description' => $this->faker->paragraph(rand(10, 20)),
            'views' => 0,
            'state' => $this->faker->randomElement(UrlStates::states()),
        ];
    }
}
