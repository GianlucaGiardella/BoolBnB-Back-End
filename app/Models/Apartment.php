<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\View;
use App\Models\Image;
use GuzzleHttp\Client;
use App\Models\Message;
use App\Models\Service;
use App\Models\Sponsor;
use Illuminate\Support\Str;
use App\Models\ApartmentSponsor;
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

    public function active_sponsors(){
        return $this->sponsors(ApartmentSponsor::class)->withPivot('start_date','end_date');
    }
}