<?php

namespace App\Models;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    public function services()
    {
        return $this->belongsToMany(Apartment::class);
    }
}