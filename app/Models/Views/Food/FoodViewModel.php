<?php

namespace App\Models\Views\Food;


class FoodViewModel
{
    /**
     * @var string
     */
    public $key;

    /**
     * @var FoodViewDataModel[]
     */
    public $data = [];

    public function __construct($data)
    {
        $this->key = $data->key;

        $clients = json_decode($data->data, true);

        foreach ($clients as $client) {
            $this->data[] = new FoodViewDataModel($client);
        }

    }
}
