<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'text_content',
        'email',
        'name',
    ];

    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }
}
