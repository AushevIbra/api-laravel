<?php

namespace App\Models\Views;


class ClientViewModel
{
    /**
     * @var string
     */
    public $key;

    /**
     * @var ClientViewDataModel[]
     */
    public $data = [];

    public function __construct($data)
    {
        $this->key = $data->key;

        $clients = json_decode($data->data, true);

        foreach ($clients as $client) {
            $this->data[] = new ClientViewDataModel($client);
        }

    }
}
