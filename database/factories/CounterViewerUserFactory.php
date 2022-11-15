<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CounterViewerUser>
 */
class CounterViewerUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $rand = rand(0, 12);

        $date = date('Y-m-d H:i:s', strtotime('-' . $rand . ' month'));

        return [
            'ip' => fake()->ipv4(),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
