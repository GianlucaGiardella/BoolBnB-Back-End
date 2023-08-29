<?php

namespace App\Models;

use App\Models\View;
use App\Models\Image;
use App\Models\Message;
use App\Models\Service;
use App\Models\Sponsor;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GuzzleHttp\Client;

class Apartment extends Model
{
    use HasFactory;

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class, 'apartment_sponsor');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'apartment_service');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public static function slugger($string)
    {
        $baseSlug = Str::slug($string);

        $i = 1;

        $slug = $baseSlug;

        while (self::where('slug', $slug)->first()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }

    public function getRouteKey()
    {
        return $this->slug;
    }
}