<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTahap extends Model
{
    use HasFactory;
    protected $table = "detail_tahaps";
    protected $fillable = [
        'nama',
        'time',
        'end',
        'deskripsi',
        'attachment',
        'tahap_id',
    ];
    public $timestamps = false;

    public function tahap()
    {
        return  $this->belongsTo(Tahap::class);
    }
    public function members()
    {
        return $this->belongsToMany(User::class, 'detail_member');
    }
}
