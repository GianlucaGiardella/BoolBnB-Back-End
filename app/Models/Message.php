<?php

namespace App\Models;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    protected $fillable = [
        'text_message', 'email_sender', 'apartment_id'
    ];
    
    protected $dates = ['sent_date'];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
    
}