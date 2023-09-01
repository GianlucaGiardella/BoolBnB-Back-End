<?php

namespace App\Models;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}