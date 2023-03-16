<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visualization extends Model
{
    use HasFactory;

    protected $fillable = ['user_ip'];

    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }
}
