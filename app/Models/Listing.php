<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
  use HasFactory;

  protected $fillable = [
    'beds',
    'bathrooms',
    'area',
    'city',
    'postal_code',
    'street',
    'street_number',
    'price',
  ];
}
