<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
        'name',
        'iso_3166_1_a_2',
        'iso_3166_1_a_3',
        'dialing_code',
    ];

    public function artists()
    {
        return $this->hasMany(Artist::class);
    }
}
