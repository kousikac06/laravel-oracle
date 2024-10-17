<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokensTestPostgres extends Model
{
    protected $connection = 'pgsql';
    protected $table      = 'tokens_test';
  
    protected $fillable = [
        'name',
        'token',
    ];
}
