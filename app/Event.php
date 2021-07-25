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
        'contact_person'
    ];
}
