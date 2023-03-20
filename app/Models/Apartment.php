<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'rooms',
        'beds',
        'bathrooms',
        'square_meters',
        'address',
        'longitude',
        'latitude',
        'visible',
        'image'
    ];

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class);
    }

    public function sponsorships(){
        return $this->belongsToMany(Sponsorship::class);
    }

    public function visualizations(){
        return $this->hasMany(Visualization::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
