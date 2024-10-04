<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokensTestMysql extends Model
{
    protected $table = 'tokens_test';
  
    protected $fillable = [
        'name',
        'token',
    ];
}
