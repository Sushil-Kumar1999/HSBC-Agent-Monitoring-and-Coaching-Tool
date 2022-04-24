<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reward>
 */
class RewardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $is_skillbuilder = (bool)rand(0,1);
        $title = "";
        if($is_skillbuilder){
            $title = $this->faker->randomElement([
                'Engaging with your clients',
                'Leaving a lasting impression',
                'Increasing your CCPOH',
                'Understanding your score',
                '2022: Updated Customer Service guidelines',
                'Increasing customer satisfaction',
            ]);
            $content = $this->faker->randomElement([
                'Watch this video: https://www.youtube.com/watch?v=YVgBjTxfjSs',
                'Please complete this quiz: https://quiz.hsbc.co.uk/Engaging-with-clients',
                'Well done for fixing the dip in your statistics'
            ]);
        }else{
            $title = 'You are eligible for a reward!';
            $content = $this->faker->randomElement([
                'Enjoy a 15 minute coffee break',
                'Treat yourself to a box of chocolates on us',
                'Good job on increasing your CCPOH!',
            ]);
        }

        return [
            'supervisor_id' => User::inRandomOrder()->where('role', '=', 'supervisor')->first()->id,
            'psid'=> User::inRandomOrder()->where('role', '=', 'agent')->first()->id,
            'type' => $is_skillbuilder?'skillbuilder':'reward',
            'title' => $title,
            'content' => $content,
            'redeemed' => (bool)rand(0,1),
        ];
    }
}
