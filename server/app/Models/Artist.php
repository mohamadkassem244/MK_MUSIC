<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $table = 'artists';

    protected $fillable = [
        'real_name',
        'job_name',
        'birth_date',
        'start_date',
        'retirement_date',
        'gender',
        'bio',
        'image',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'artist_genre');
    }
}
