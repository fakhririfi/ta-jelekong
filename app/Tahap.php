<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahap extends Model
{
    use HasFactory;
    protected $table = "tahaps";
    protected $fillable = [
        'nama',
        'event_id',
    ];
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(DetailTahap::class);
    }
}
