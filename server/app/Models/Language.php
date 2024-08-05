<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';

    protected $fillable = [
        'name',
        'code',
        'native_name',
        'writing_system',
    ];

    public function tracks()
    {
        return $this->belongsToMany(Track::class, 'track_language');
    }

}
