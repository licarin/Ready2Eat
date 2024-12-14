<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
class CustomerController extends Controller
{
    public function index()
    {
        
        $restaurants = Restaurant::all();
        return view('customer.restaurants.index',["restaurants"=>$restaurants]);
    }

    public function showLogin()
    {
        return view('customer.login');
    }

    public function login(Request $request){
        $customer = Customer::where('email', $request->email)->first();
        if (($customer && Hash::check($request->password, $customer->password))) {
            session()->put('id', $customer->id);
            session()->put('email', $customer->email);
            session()->put('name', $customer->name);

            return redirect()->route('customer.restaurants.index')->with('success', 'Successfully logged in!');
        } else {
            return redirect()->route('customer.login')->with('error', 'Invalid credentials, please check your email or password!');
        }
    }


    public function search(Request $request)
    {
        $query = Restaurant::query();

        if ($request->has('location') && $request->location) {
            $query->where('location', 'LIKE', "%{$request->location}%");
        }

        if ($request->has('price_range') && $request->price_range) {
            [$min, $max] = explode('-', $request->price_range);
            $query->whereBetween('average_price', [(float)$min, (float)$max]);
        }

        $restaurants = $query->paginate(10);

        return view('customer.restaurants.index', compact('restaurants'));
    }

    public function showRestaurant($id)
    {
        $restaurant = Restaurant::with('tables')->findOrFail($id);
        return view('customer.restaurants.show', compact('restaurant'));
    }

    public function viewReservations()
    {
        $reservations = Reservation::with(['restaurant', 'table'])
            ->where('customer_id', session('id'))
            ->orderBy('reservation_time', 'desc')
            ->get();

        return view('customer.reservations', compact('reservations'));
    }

    public function storeReservation(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'table_id' => 'required|exists:tables,id',
            'reservation_time' => 'required|date|after:now',
            'guest_count' => 'required|integer|min:1',
        ]);

        // Cek apakah meja sudah dipesan pada waktu yang sama dengan status 'confirmed'
        $existingReservation = Reservation::where('table_id', $data['table_id'])
            ->where('reservation_time', $data['reservation_time'])
            ->where('status', 'confirmed')
            ->exists();

        if ($existingReservation) {
            return redirect()->back()->withErrors(['error' => 'This table is already reserved for the selected time.']);
        }

        // Simpan data ke database
        Reservation::create($data);

        return redirect()->route('customer.reservations')->with('success', 'Reservation successfully created!');
    }


    public function editReservation($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Cek apakah reservasi milik customer yang sedang login dan statusnya masih 'pending'
        if ($reservation->customer_id != session('id') || $reservation->status != 'pending') {
            return redirect()->route('customer.reservations')->with('error', 'You cannot edit a reservation that is not pending.');
        }

        return view('customer.edit', compact('reservation'));
    }


    public function updateReservation(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        // Cek apakah statusnya 'pending'
        if ($reservation->status != 'pending') {
            return redirect()->route('customer.reservations')->with('error', 'You cannot update a reservation that is not pending.');
        }

        $data = $request->validate([
            'reservation_time' => 'required|date|after:now',
            'guest_count' => 'required|integer|min:1',
        ]);

        $reservation->update($data);

        return redirect()->route('customer.reservations')->with('success', 'Reservation updated successfully!');
    }


    public function deleteReservation($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Ensure the customer owns the reservation and that it is pending
        if ($reservation->customer_id != session('id')) {
            abort(403, 'Unauthorized action.');
        }

        if ($reservation->status != 'pending') {
            return redirect()->route('customer.reservations')->with('error', 'You can only cancel a reservation that is pending.');
        }

        // Delete the reservation
        $reservation->delete();

        return redirect()->route('customer.reservations')->with('success', 'Reservation successfully canceled!');
    }





}
