<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'name', 'category', 'contact'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

