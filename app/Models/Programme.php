<?php

declare(strict_types = 1);

namespace App\Models;

use DateTime;
use App\Models\Model;
use App\Models\Channel;
use App\Models\Timezone;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Programme extends Model
{
    /**
     * Path to the storage with thumbnails.
     *
     * @var string
     */
    const STORAGE = 'storage' . DIRECTORY_SEPARATOR . 'programmes' . DIRECTORY_SEPARATOR . 'thumbnails';

    /**
     * Indicates if the model has timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Set the programme's start.
     * Update the duration.
     *
     * @param  string  $value
     * @return void
     */
    public function setStartAttribute($value): void
    {
        $this->attributes['start'] = $value;

        if ($this->end) {
            $this->attributes['duration'] = $this->end->getTimestamp() - (new DateTime($value))->getTimestamp();
        }
    }

    /**
     * Set the programme's end.
     * Update the duration.
     *
     * @param  string  $value
     * @return void
     */
    public function setEndAttribute($value): void
    {
        $this->attributes['end'] = $value;

        if ($this->start) {
            $this->attributes['duration'] = (new DateTime($value))->getTimestamp() - $this->start->getTimestamp();
        }
    }

    /**
     * Get the programme's start.
     *
     * @param  string  $value
     * @return \DateTime|null
     */
    public function getStartAttribute($value): ?DateTime
    {
        return $value
            ? app('timezone')->createDateTime($value)
            : $value;
    }

    /**
     * Get the programme's end.
     *
     * @param  string  $value
     * @return \DateTime|null
     */
    public function getEndAttribute($value): ?DateTime
    {
        return $value
            ? app('timezone')->createDateTime($value)
            : $value;
    }

    /**
     * Get the programme's (url to the) thumbnail.
     *
     * @param  string  $value
     * @return string
     */
    public function getThumbnailAttribute($value)
    {
        return asset(self::STORAGE . DIRECTORY_SEPARATOR . $value);
    }

    /**
     * Get the channel that belongs the programme.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }
}
