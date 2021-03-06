<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Food
 * @property integer $id
 * @property string $name
 * @property integer $price
 * @property string $img
 */
class Food extends Model
{
    const ATTR_ID    = 'id';
    const ATTR_NAME  = 'name';
    const ATTR_PRICE = 'price';
    const ATTR_IMG   = 'img';

    const TABLE_NAME = 'foods';

    public $fillable = [
        self::ATTR_NAME,
        self::ATTR_PRICE,
        self::ATTR_IMG
    ];

    protected $appends = [
        'image',
    ];

    public function getImageAttribute()
    {
        return $this->attributes['image'] = ($this->img) ? url('storage/' . $this->img) : null;
    }
}
