<?php

namespace App\Models;

use App\Models\View;
use App\Models\Image;
use App\Models\Message;
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

    public function images()
    {
        return $this->belongsTo(Image::class);
    }

    public function views()
    {
        return $this->belongsTo(View::class);
    }

    public function messages()
    {
        return $this->belongsTo(Message::class);
    }
}