<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UseUuid
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model)
        {
            $model->incrementing = false;
            $model->keyType = 'string';

            $model->{$model->getKeyName()} = Str::uuid()->toString();

        });

        static::retrieved(function ($model)
        {
            $model->incrementing = false;
        });
    }
}
