<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $table = 'tracks';

    protected $fillable = [
        'title',
        'length',
        'play_count',
        'image',
        'path',
        'artist_id',
        'album_id',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_track');
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'user_like_track');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'track_genre');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'track_language');
    }
}
