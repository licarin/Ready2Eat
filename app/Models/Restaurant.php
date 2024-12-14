<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory, HasUuids ;

    protected $fillable = ['name', 'location', 'average_price','description',  'photos', 'owner_id'];

    // Relasi ke tabel users (owner restoran)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }



    // Relasi ke tabel tables
    public function tables()
    {
        return $this->hasMany(Table::class, 'restaurant_id');
    }

    // Relasi ke tabel reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'restaurant_id');
    }
}
