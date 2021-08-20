<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = "events";

    protected $fillable = [
        'name',
        'time',
        'end',
        'location',
        'description',
        'price',
        'quota',
        'image',
        'organizer',
        'category',
        'contact_person',
        'user_id',
        'schedule',
        'type'
    ];
    public function tahaps()
    {
        return $this->hasMany(Tahap::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'event_id');
    }
}
