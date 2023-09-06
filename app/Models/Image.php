<?php

namespace App\Models;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'apartment_id',
        'img_url',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}