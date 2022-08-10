<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Order\OrderService;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    protected $orderService;
    
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function confirmOrder(OrderRequest $request) 
    {
        // $this->validate($request, [
        //     'customer.customer_name'         =>'required',
        //     'customer.customer_email'         =>'required|email',
        //     'customer.customer_phone'          => 'required',
        //     'customer.customer_address'   => 'required',
        // ]);
        $order = $this->orderService->confirmOrder($request);
        if (!$order) {
            return response()->json([
                'data' => [
                    'message' => 'Confirm Order failed!',
                ],
            ], 401);
        }
        return response()->json(['order' => $order, 'message' => 'Confirm Order successful!'], 200);
    }
}
