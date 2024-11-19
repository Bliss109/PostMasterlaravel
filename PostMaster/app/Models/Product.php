<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; //Seeding test data into the db
use Illuminate\Database\Eloquent\Model; // For interacting with database

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
      'title',
      'price',
      'product_code',
      'description',
      'photo'
    ];
}
