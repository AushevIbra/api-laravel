<?php

namespace App\Models\Views\Order;


use Carbon\Carbon;

class OrderViewModel
{
    /**
     * @var string
     */
    public $key;

    /**
     * @var OrderViewDataModel[]
     */
    public $data = [];

    public function __construct($data)
    {
        $this->key = (new Carbon($data->key))->isoFormat("dddd, Do MMMM ");

        $orders = json_decode($data->data, true);

        foreach ($orders as $order) {
            $this->data[] = new OrderViewDataModel($order);
        }

    }
}
