<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Table;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter pencarian dan filter
        $search = $request->input('search');
        $location = $request->input('location');
        
        $query = Restaurant::query();

        // Filter dan pencarian
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($location) {
            $query->where('location', 'like', '%' . $location . '%');
        }

        // Urutkan dari yang terbaru dan paginasi
        $restaurants = $query->orderBy("id", "desc")->paginate(10);

        return view('admin.restaurants.index', compact('restaurants', 'search', 'location'));
    }

    public function restaurants()
    {
        $restaurants = Restaurant::all();
        return view('admin.restaurants.index', compact('restaurants'));
    }

    public function createRestaurant()
    {
        return view('admin.restaurants.create');
    }

    public function storeRestaurant(Request $request)
    {   
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'average_price' => 'required|numeric|min:0',
        ]);

        $restaurant = Restaurant::create($data);

        // Upload Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/images');
                $restaurant->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.restaurants')->with('success', 'Restoran berhasil ditambahkan!');
    }

    public function editRestaurant($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('admin.restaurants.edit', compact('restaurant'));
    }

     public function updateRestaurant(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'average_price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update data restoran
        $restaurant->update($data);

        // Jika ada foto baru, hapus foto lama dan tambahkan foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($restaurant->photos) {
                \Storage::delete($restaurant->photos);
            }
            $path = $request->file('photo')->store('public/images');
            $restaurant->update(['photos' => $path]);
        }

        return redirect()->route('admin.restaurants')->with('success', 'Restoran berhasil diperbarui!');
    }

    public function showRestaurant($id)
    {
        $restaurant = Restaurant::with('tables')->findOrFail($id);
        return view('admin.restaurants.show', compact('restaurant'));
    }



    
    public function deleteRestaurant($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('admin.restaurants')->with('success', 'Restoran berhasil dihapus!');
    }

    public function reservations()
    {
        $reservations = Reservation::with(['customer', 'restaurant', 'table'])->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function approveReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'confirmed';
        $reservation->save();

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation confirmed!');
    }

    public function rejectReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'rejected';
        $reservation->save();

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation rejected.');
    }

    public function createTable($restaurantId)
    {
        // Get the restaurant by ID
        $restaurant = Restaurant::findOrFail($restaurantId);
    
        // Return the view with the restaurant data and pass restaurantId
        return view('admin.tables.create', compact('restaurant', 'restaurantId'));
    }
    
    public function storeTable(Request $request, $restaurantId)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'number' => 'required|integer|min:1',
            'seats' => 'required|integer|min:1',
        ]);

        // Check if the table number already exists for the specified restaurant
        if (Table::where('number', $request->number)
                ->where('restaurant_id', $restaurantId)
                ->exists()) {
            return redirect()->back()->withErrors(['number' => 'Table number already exists for this restaurant.']);
        }

        // Create the new table for the restaurant
        $table = Table::create([
            'restaurant_id' => $restaurantId,
            'number' => $request->number,
            'seats' => $request->seats,
        ]);

        // Redirect back to the restaurant's page with a success message
        return redirect()->route('admin.restaurants.show', $restaurantId)
                        ->with('success', 'Table created successfully!');
    }


    public function editTable($id)
    {
        
        $table = Table::findOrFail($id);

        
        $restaurantId = $table->restaurant_id;

        
        return view('admin.tables.edit', compact('table', 'restaurantId'));
    }

    
    public function updateTable(Request $request, $id)
    {
        
        $validated = $request->validate([
            'number' => 'required|integer|min:1',
            'seats' => 'required|integer|min:1',
        ]);

        // Find the table by ID
        $table = Table::findOrFail($id);

        // Check if the new table number already exists (excluding the current table)
        if (Table::where('number', $request->number)
                ->where('restaurant_id', $table->restaurant_id)
                ->where('id', '!=', $id)
                ->exists()) {
            return redirect()->back()->withErrors(['number' => 'Table number already exists in this restaurant.']);
        }

        // Update the table details
        $table->update($validated);

        // Redirect back to the restaurant's tables page with success message
        return redirect()->route('admin.restaurants.show', $table->restaurant_id)
                        ->with('success', 'Table updated successfully!');
    }


    
    public function deleteTable($id)
    {
        // Find the table by ID
        $table = Table::findOrFail($id);

        // Store the restaurant ID to redirect after deletion
        $restaurantId = $table->restaurant_id;

        // Delete the table
        $table->delete();

        // Redirect back to the restaurant's page with success message
        return redirect()->route('admin.restaurants.show', $restaurantId)
                         ->with('success', 'Table deleted successfully!');
    }



}
