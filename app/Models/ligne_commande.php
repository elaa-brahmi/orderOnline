<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ligne_commande extends Model
{
    use HasFactory;
    protected $fillable=['id','idfood','price','quantity'];
}
