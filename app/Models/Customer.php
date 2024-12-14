<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'email',
        'phoneNum',
        'address',
        'password',
    ];

    

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
