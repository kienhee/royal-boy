<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $fillable = [
        "name", "phone", "email", "country", "address",
        "townCity", "countryState", "postcodeZIP", "total", "quantity", "status", "payment", "notes"
    ];
    use HasFactory;
}
