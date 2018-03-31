<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OAuthen extends Model
{
    protected $table = "auth";
    protected $fillable = array('access_token', 'timelife');
}
