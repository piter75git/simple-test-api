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
    private static $datetimezone;

    /**
     * Set the PHP DateTimeZone object
     * based on given timezone.
     *
     * @param string  $timezone
     * @return void
     */
    public static function setDateTimeZone(string $timezone): void
    {
        self::$datetimezone = new DateTimeZone(
            self::formatToPhpSyntax($timezone)
        );
    }

    /**
     * Get the current PHP DateTimeZone object.
     *
     * @return \DateTimeZone
     */
    public static function getDateTimeZone(): DateTimeZone
    {
        if (! self::$datetimezone) {
            self::$datetimezone = new DateTimeZone(config('app.timezone'));
        }

        return self::$datetimezone;
    }

    /**
     * Create the datetime object based on the value (date)
     * and the current timezone.
     *
     * @param string  $value  Date format.
     * @return \DateTime
     */
    public static function createDateTime(string $value): DateTime
    {
        return (new DateTime($value))->setTimezone(self::getDateTimeZone());
    }

    /**
     * Determine if the timezone is valid.
     *
     * @param string  $timezone
     * @return bool
     */
    public static function isValid(string $timezone): bool
    {
        return in_array(
            self::formatToPhpSyntax($timezone),
            DateTimeZone::listIdentifiers()
        );
    }

    /**
     * Format the timezone to the PHP accepted timezone syntax.
     *
     * @param string  $timezone
     * @return string
     */
    private static function formatToPhpSyntax(string $timezone): string
    {
        return str_replace('-', '/', $timezone);
    }

    /**
     * Format the timezone to the URL safe syntax.
     *
     * @param string  $timezone
     * @return string
     */
    private static function formatToUrlSyntax(string $timezone): string
    {
        return str_replace('/', '-', $timezone);
    }
}
