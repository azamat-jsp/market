<?php

namespace App\Tbuy\Identify\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIdentify extends Model
{
    use HasFactory;

    protected $table = 'user_identifiers';

    protected $fillable = [
        'user_id',
        'ip_address',
    ];
}
