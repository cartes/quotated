<?php

namespace App\Traits;

use Jenssegers\Date\Date;

/**
 * Trait DatesTranslator
 * returns dates in spanish or other languages, defined at app.locale
 *
 *
 * @package App\Traits
 */
trait DatesTranslator
{
    public function getCreatedAtAttribute($created_at)
    {
        return new Date($created_at);
    }

    public function getUpdatedAtAttribute($updated_at)
    {
        return new Date($updated_at);
    }

    public function getDeletedAtAttribute($deleted_at)
    {
        return new Date($deleted_at);
    }
}