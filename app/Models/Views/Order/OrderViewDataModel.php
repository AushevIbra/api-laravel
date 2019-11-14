<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 07.11.2019
 * Time: 7:44
 */

namespace App\Models\Views\Order;


class OrderViewDataModel
{
    /**
     * @var integer $id
     */
    public $id;
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $time;

    /**
     * @var string
     */
    public $letter;

    /**
     * @var bool
     */
    public $active = false;

    public function __construct($order)
    {
        $this->name   = $order['name'];
        $this->letter = mb_substr($order['name'], 0, 1);
        $this->id     = $order['id'];
        $this->time   = date("H:m", strtotime($order['date_delivery']));
    }
}
