<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendez extends Model
{
    use HasFactory;
    protected $fillable = ['id_vehicules', 'users', 'datedebut', 'datefin'];
}
