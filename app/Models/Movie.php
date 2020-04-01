<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'poster',
        'release_date',
        'rating',
        'genres',
        'director',
    ];

    protected $dates = [
        'release_date'
    ];

    /**
     * @param  string  $value
     * @return void
     */
    public function setReleaseDateAttribute(string $value)
    {
        $this->attributes['release_date'] = Carbon::parse($value);
    }

    /**
     * @param  array  $value
     * @return void
     */
    public function setGenresAttribute(array $value)
    {
        $this->attributes['genres'] = json_encode($value);
    }
}
