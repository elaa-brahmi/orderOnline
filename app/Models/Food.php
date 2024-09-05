<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $primaryKey = 'idfood';
    protected $fillable = ['name', 'description', 'category','price','photo'];
}
