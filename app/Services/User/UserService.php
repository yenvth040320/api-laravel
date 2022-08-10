<?php 

namespace App\Services\User;

use App\Services\BaseService;
use App\Repositories\User\UserRepositoryInterface;
use App\Models\User;

class UserService extends BaseService
{
    protected $userRepo;
    
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getRepository()
    {

    }

    public function registerUser($request)
    {
        return $this->userRepo->registerUser($request);
    }

    public function loginUser($request)
    {
        return $this->userRepo->loginUser($request);
    }
}