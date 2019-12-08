<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';
    protected $primaryKey = 'package_id';
    public $timestamps = true;
}
