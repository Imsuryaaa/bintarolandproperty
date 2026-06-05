<?php

namespace Database\Seeders;

use App\Models\Condition;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    private array $conditions = [
        ['name' => 'Baru', 'slug' => 'baru'],
        ['name' => 'Second', 'slug' => 'second'],
    ];

    public function run(): void
    {
        foreach ($this->conditions as $condition) {
            Condition::firstOrCreate(
                ['slug' => $condition['slug']],
                $condition
            );
        }
    }
}
