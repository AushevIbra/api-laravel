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

        $foods = json_decode($data->data, true);

        foreach ($foods as $food) {
            $this->data[] = new FoodViewDataModel($food);
        }

    }
}
