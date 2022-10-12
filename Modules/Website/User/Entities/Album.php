<?php

namespace Modules\Website\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Entities\Media;
use Modules\Website\User\Entities\Client;

class Album extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['status' => 'boolean'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->client_id = auth('client')->id();
        });
    }

    /**
     * Get the current album pictures
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pictures()
    {
        return $this->hasMany(Media::class);
    }

    /**
     * Get the client that has the album
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
