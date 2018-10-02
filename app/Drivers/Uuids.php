<?php 
namespace App\Drivers;

use Webpatser\Uuid\Uuid;
trait Uuids
{

    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();
        die('test');
        static::create(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
}