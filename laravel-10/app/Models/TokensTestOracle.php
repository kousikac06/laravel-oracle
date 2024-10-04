<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokensTestOracle extends Model
{
    protected $connection = 'oracle';
    protected $table      = 'tokens_test';
  
    protected $fillable = [
        'name',
        'token',
    ];
}
