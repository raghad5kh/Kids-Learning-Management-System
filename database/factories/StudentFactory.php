<?php
namespace Database\Seeders;
namespace Database\Factories;
use App\Models\Archeievement;
use App\Models\Record;
use App\Models\Quiz_result;
use App\Models\Complaint;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [



            'nickname' => $this->faker->name(),
            'record_id' =>Record::all()->random()->id,
        //    'archeivement_id' =>Archeievement::all()->random()->id,
            'quiz_result_id' =>Quiz_result::all()->random()->id,
            'photo' => $this->faker->imageUrl($width = 200, $height = 200),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),


        ];
    }
}
