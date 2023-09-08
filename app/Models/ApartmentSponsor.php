<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentSponsor extends Model
{
    use HasFactory;

    // serve per far funzionare il metodo attach() in SponsorshipController
    protected $fillable = [
        'apartment_id',
        'sponsor_id',
        'start_date',
        'end_date',
    ];

    // serve per far funzionare il metodo attach() in SponsorshipController
    protected $table = 'apartment_sponsor';
}
