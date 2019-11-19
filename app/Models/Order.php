<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Order
 * @property integer $id
 * @property integer $name
 * @property string $address
 * @property string $city
 * @property string $phone
 * @property string $comment
 * @property integer $status
 * @property string $date_delivery
 * @property float $total_sum
 * @property integer $client_id
 */
class Order extends Model
{
    const ATTR_ID            = 'id';
    const ATTR_NAME          = 'name';
    const ATTR_ADDRESS       = 'address';
    const ATTR_CITY          = 'city';
    const ATTR_PHONE         = 'phone';
    const ATTR_COMMENT       = 'comment';
    const ATTR_STATUS        = 'status';
    const ATTR_DATE_DELIVERY = 'date_delivery';
    const ATTR_TOTAL_SUM     = 'total_sum';
    const ATTR_CLIENT_ID     = 'client_id';

    const STATUS_APPROVED = 0;
    const STATUS_READY    = 1;

    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_ADDRESS,
        self::ATTR_PHONE,
        self::ATTR_COMMENT,
        self::ATTR_STATUS,
        self::ATTR_DATE_DELIVERY,
        self::ATTR_TOTAL_SUM,
        self::ATTR_CLIENT_ID,
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'order_foods')->withPivot([OrderFoods::ATTR_UNIT,
                                                                            OrderFoods::ATTR_COUNT,
                                                                            OrderFoods::ATTR_COMMENT]);
    }
}
