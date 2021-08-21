<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = [
        'event_id',
        'code',
        'ticket',
        'ticket_price',
        'amount',
        'title',
        'first_name',
        'last_name',
        'email',
        'phone',
        'status',
        'proof',
    ];

    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id');
    }
}
