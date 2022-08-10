<?php
namespace App\Repositories\Order;

use App\Repositories\BaseRepository;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;


class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Order::class;
    }

    public function confirmOrder($request)
    {
        $customer = $request->customer;
        $cart = $request->order;
        
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_code =  strtoupper(substr(md5(microtime()),rand(0,26),5));
        $total = 0;
        if( $cart != null){
            foreach($cart as $key => $item){
                $total += $item['quantity']*$item['price'];
            }
        }
        $order = Order::create([
            'customer_name' =>  $customer['customer_name'],
            'customer_email' =>  $customer['customer_email'],
            'customer_phone' => $customer['customer_phone'],
            'customer_address' => $customer['customer_address'],
            'order_date' =>  $today,
            'order_number' => $order_code,
            'total' => $total
        ]);
    
        if( $cart != null){
            foreach($cart as $key => $item){
                $order_details = new OrderDetail;
                $order_details->order_id = $order->id;
                $order_details->product_id = $item['id'];
                $order_details->price = $item['price'];
                $order_details->quantity = $item['quantity'];
                $order_details->total =  $item['price']*$item['quantity'];
                $order_details->save();
            }
        }
        return $order;
    }
    
}