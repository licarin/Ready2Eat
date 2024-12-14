<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use App\Models\Category;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        $restaurant = Restaurant::create([
            'name' => 'Delicious Italian',
            'description' => 'Italian cuisine with authentic flavors.',
            'location' => 'Downtown City Center',
            'average_price' => 20.50,
            'admin_id' => null, // Assuming this is the admin's user ID\
            'photos' => '/uploads/restaurants/resto.jpg',
        ]);

        // Attach categories to the restaurant
        
    }
}
