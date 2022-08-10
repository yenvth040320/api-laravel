<?php 

namespace App\Services\Order;

use App\Services\BaseService;
use App\Repositories\Order\OrderRepositoryInterface;

class OrderService extends BaseService
{
    protected $orderRepo;
    
    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function getRepository()
    {

    }

    public function confirmOrder($request)
    {
        return $this->orderRepo->confirmOrder($request);
    }
}