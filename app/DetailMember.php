<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMember extends Model
{
    use HasFactory;
    protected $table = "detail_member";

    protected $fillable = ["user_id", "detail_tahap_id"];

    public $timestamps = false;
}
