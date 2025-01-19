<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Category = [
            [
                'category' => 'Biasa'
            ],
            [
                'category' => 'Sprin'
            ],
            [
                'category' => 'SIJ'
            ],
            [
                'category' => 'Rahasia'
            ],
            [
                'category' => 'Bratel'
            ],
            [
                'category' => 'Bravax'
            ],
        ];

        foreach ($Category as $key => $val) {
            Category::create($val);
        }
    }
}
