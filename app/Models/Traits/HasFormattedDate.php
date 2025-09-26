<?php

namespace App\Models\Traits;

trait HasFormattedDate
{
    /**
     * overwrite base model serializeDate method to formatting dates to a specific format
     *
     * @param \DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}