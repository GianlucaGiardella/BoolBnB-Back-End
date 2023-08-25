<?php

namespace App\Models;

use App\Models\Service;
use App\Models\Sponsor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Apartment extends Model
{
    use HasFactory;

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}