<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pkb extends Model
{
    public $table = "pkb";
    public $fillable = ["country", "code", "value", "year", "info"];
}
