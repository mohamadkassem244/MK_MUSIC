<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';

    protected $fillable = [
        'name',
        'description',
    ];

    public function tracks()
    {
        return $this->belongsToMany(Track::class, 'track_genre');
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'artist_genre');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_genre');
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_genre');
    }
}
