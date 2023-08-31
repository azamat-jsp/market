<?php

namespace App\Tbuy\ProfessionalLevel\Models;

use App\Traits\HasAllTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalLevel extends Model
{
    use HasFactory;
    use HasAllTranslations;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public array $translatable = [
        'name',
    ];
}
