<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'price',
        'duration_hours'
    ];

    public function apartments(){
        return $this->belongsToMany(Apartment::class);
    }
}
