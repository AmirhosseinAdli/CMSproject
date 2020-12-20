<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Image extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function setAltAttribute($value)
    {
        $this->attributes['alt'] = $value ?? $this->title;
    }

    public function getUrlAttribute()
    {
        return Storage::url($this->attributes['path']);
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
