<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Running Shoes',
                'slug' => 'running-shoes',
                'description' => 'Sepatu untuk olahraga lari dan jogging',
                'icon' => 'running.svg',
                'is_active' => true
            ],
            [
                'name' => 'Casual Shoes',
                'slug' => 'casual-shoes',
                'description' => 'Sepatu santai untuk kegiatan sehari-hari',
                'icon' => 'casual.svg',
                'is_active' => true
            ],
            [
                'name' => 'Sneakers',
                'slug' => 'sneakers',
                'description' => 'Sepatu sneakers stylish dan trendy',
                'icon' => 'sneakers.svg',
                'is_active' => true
            ],
            [
                'name' => 'Formal Shoes',
                'slug' => 'formal-shoes',
                'description' => 'Sepatu formal untuk acara resmi',
                'icon' => 'formal.svg',
                'is_active' => true
            ],
            [
                'name' => 'Sport Shoes',
                'slug' => 'sport-shoes',
                'description' => 'Sepatu olahraga multifungsi',
                'icon' => 'sport.svg',
                'is_active' => true
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}