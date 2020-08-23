<?php

declare(strict_types = 1);

namespace App\Models;

use App\Models\Model;
use App\Models\Programme;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Channel extends Model
{
    /**
     * Path to the storage with icons.
     *
     * @var string
     */
    const STORAGE = 'storage' . DIRECTORY_SEPARATOR . 'channels' . DIRECTORY_SEPARATOR . 'icons';

    /**
     * Indicates if the model has timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

     /**
     * Get the channel's (url to the) icon.
     *
     * @param  string  $value
     * @return string
     */
    public function getIconAttribute($value)
    {
        return asset(self::STORAGE . DIRECTORY_SEPARATOR . $value);
    }

   /**
     * Get the programmes for the channel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programmes(): HasMany
    {
        return $this->hasMany(Programme::class);
    }
}
