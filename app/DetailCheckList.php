<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCheckList extends Model
{
    use HasFactory;
    protected $table = "detail_check_lists";

    protected $fillable = ["nama", "completed", "detail_tahap_id"];

    public $timestamps = false;
}
