<?php

declare(strict_types = 1);

namespace App\Models;

use DateTime;
use DateTimeZone;

class Timezone
{
    /**
     * Current datetimezone object.
     *
     * @var DateTimeZone|null
     */
    private $datetimezone;

    /**
     * Set the PHP DateTimeZone object
     * based on given timezone.
     *
     * @param string  $timezone
     * @return void
     */
    public function setDateTimeZone(string $timezone): void
    {
        $this->datetimezone = new DateTimeZone(
            $this->formatToPhpSyntax($timezone)
        );
    }

    /**
     * Get the current PHP DateTimeZone object.
     *
     * @return \DateTimeZone
     */
    public function getDateTimeZone(): DateTimeZone
    {
        if (! $this->datetimezone) {
            $this->datetimezone = new DateTimeZone(config('app.timezone'));
        }

        return $this->datetimezone;
    }

    /**
     * Create the datetime object based on the value (date)
     * and the current timezone.
     *
     * @param string  $value  Date format.
     * @return \DateTime
     */
    public function createDateTime(string $value): DateTime
    {
        return (new DateTime($value))->setTimezone($this->getDateTimeZone());
    }

    /**
     * Determine if the timezone is valid.
     *
     * @param string  $timezone
     * @return bool
     */
    public function isValid(string $timezone): bool
    {
        return in_array(
            $this->formatToPhpSyntax($timezone),
            DateTimeZone::listIdentifiers()
        );
    }

    /**
     * Format the timezone to the PHP accepted timezone syntax.
     *
     * @param string  $timezone
     * @return string
     */
    private function formatToPhpSyntax(string $timezone): string
    {
        return str_replace('-', '/', $timezone);
    }

    /**
     * Format the timezone to the URL safe syntax.
     *
     * @param string  $timezone
     * @return string
     */
    private function formatToUrlSyntax(string $timezone): string
    {
        return str_replace('/', '-', $timezone);
    }
}
