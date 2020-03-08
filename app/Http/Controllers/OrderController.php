<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Client;
use App\Models\Order;
use App\Http\Resources\Order as OrderResource;
use App\Models\Views\Order\OrderViewModel;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = [
            $request->get('date_from', date("Y-m-d")),
            $request->get('date_to', date("Y-m-d", strtotime("2040-11-23")))
        ];

        $sql    = <<<SQL
    DATE_FORMAT(orders.date_delivery, '%d.%m.%Y') as "key",  CONCAT(

 '[',

   GROUP_CONCAT(JSON_OBJECT(

        "name", orders.name,
        "date_delivery", orders.date_delivery,
        "id", orders.id,
        "phone", orders.phone

)),

   ']') as "data"
SQL;
        $orders = DB::table('orders')
            ->selectRaw($sql)
            ->when($filter, function ($query) use ($filter) {
                return $query->whereBetween(Order::ATTR_DATE_DELIVERY, $filter);
            })
            ->when($request->get('name'), function ($query) use ($request) {
                return $query->where(Order::ATTR_NAME, "LIKE", "%" . $request->get('name') . "%")
                    ->orWhere(Order::ATTR_PHONE, "LIKE", "%" . $request->get('name') . "%");
            })
            ->groupBy(DB::raw("DATE_FORMAT(orders.date_delivery, '%d.%m.%Y')"))
            ->get()
            ->map(function ($order) {
                return new OrderViewModel($order);
            });
        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order = $this->service->save($request, new Order);

        return response()->json($order);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with(['client', 'foods'])->findOrFail($id);

        return new OrderResource($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
