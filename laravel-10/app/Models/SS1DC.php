<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SS1DC extends Model
{
    protected $connection = 'oracle';
    protected $table      = 'WMS_SS1.DC';
  
    protected $fillable = [
        'DC_NO',
        'DC_NAME',
        'DC_TYPE',
    ];
}
