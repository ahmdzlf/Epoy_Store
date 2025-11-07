<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name' => 'Meythal Odex',
                'customer_photo' => 'customer1.jpg',
                'testimonial' => 'Kualitas sepatu sangat bagus! Nyaman dipakai seharian dan tidak bikin kaki sakit. Highly recommended!',
                'rating' => 5,
                'is_active' => true
            ],
            [
                'customer_name' => 'Budi Santoso',
                'customer_photo' => 'customer2.jpg',
                'testimonial' => 'Pelayanan cepat dan produk sesuai ekspektasi. Harga juga sangat terjangkau untuk kualitas premium.',
                'rating' => 5,
                'is_active' => true
            ],
            [
                'customer_name' => 'Siti Nurhaliza',
                'customer_photo' => 'customer3.jpg',
                'testimonial' => 'Pengiriman cepat dan packing rapi. Sepatu nya bagus banget, sesuai foto. Puas belanja di sini!',
                'rating' => 5,
                'is_active' => true
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}