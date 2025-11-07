<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'Running Canvas Shoes',
                'slug' => 'running-canvas-shoes',
                'description' => 'Sepatu canvas nyaman untuk lari',
                'detail' => 'Sepatu running dengan material canvas berkualitas tinggi, ringan dan breathable. Cocok untuk jogging dan olahraga ringan.',
                'price' => 299000,
                'discount_price' => 249000,
                'stock' => 50,
                'sku' => 'RCS-001',
                'gender' => 'unisex',
                'is_featured' => true,
                'is_new' => true,
                'is_active' => true
            ],
            [
                'category_id' => 2,
                'name' => 'Casual Nike Shoes',
                'slug' => 'casual-nike-shoes',
                'description' => 'Sepatu casual stylish untuk sehari-hari',
                'detail' => 'Desain modern dengan kenyamanan maksimal. Material premium dan sol empuk untuk aktivitas harian.',
                'price' => 399000,
                'discount_price' => null,
                'stock' => 30,
                'sku' => 'CNS-002',
                'gender' => 'men',
                'is_featured' => true,
                'is_new' => false,
                'is_active' => true
            ],
            [
                'category_id' => 3,
                'name' => 'Trendy Slick Pro',
                'slug' => 'trendy-slick-pro',
                'description' => 'Sneakers premium dengan desain trendy',
                'detail' => 'Sneakers dengan teknologi terkini untuk kenyamanan maksimal. Desain modern cocok untuk gaya urban.',
                'price' => 599000,
                'discount_price' => null,
                'stock' => 25,
                'sku' => 'TSP-003',
                'gender' => 'unisex',
                'is_featured' => true,
                'is_new' => true,
                'is_active' => true
            ],
            [
                'category_id' => 3,
                'name' => 'Sneakers Shoes Men',
                'slug' => 'sneakers-shoes-men',
                'description' => 'Sneakers stylish untuk pria',
                'detail' => 'Kombinasi style dan kenyamanan dalam satu sepatu. Perfect untuk hang out dan casual meeting.',
                'price' => 350000,
                'discount_price' => 299000,
                'stock' => 40,
                'sku' => 'SSM-004',
                'gender' => 'men',
                'is_featured' => false,
                'is_new' => false,
                'is_active' => true
            ],
            [
                'category_id' => 4,
                'name' => 'Formal Canvas Shoes',
                'slug' => 'formal-canvas-shoes',
                'description' => 'Sepatu formal untuk acara resmi',
                'detail' => 'Sepatu formal dengan sentuhan modern. Material canvas premium untuk tampilan elegan.',
                'price' => 450000,
                'discount_price' => null,
                'stock' => 20,
                'sku' => 'FCS-005',
                'gender' => 'men',
                'is_featured' => false,
                'is_new' => false,
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Stick Running Shoes',
                'slug' => 'stick-running-shoes',
                'description' => 'Sepatu running dengan grip maksimal',
                'detail' => 'Technology running shoes dengan grip superior dan cushioning yang empuk untuk lari jarak jauh.',
                'price' => 399000,
                'discount_price' => 349000,
                'stock' => 35,
                'sku' => 'SRS-006',
                'gender' => 'unisex',
                'is_featured' => false,
                'is_new' => true,
                'is_active' => true
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}