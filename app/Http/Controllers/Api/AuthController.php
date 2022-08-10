<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserLogin;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // Đăng ký
    public function register(UserRequest $request) 
    {
        $user = $this->userService->registerUser($request);
        if (!$user) {
            return response()->json([
                'data' => [
                    'message' => 'Register failed!',
                ],
            ], 401);
        }
        return response()->json(['user' => $user, 'message' => 'Register successful!'], 200);
    }

    // Đăng nhập
    public function login(UserLogin $request)
    {
        $validated = $request->validated();
        if(!Auth::attempt( $validated))
            return response()->json([
                'message' => 'Incorrect email or password!'
        ], 401);
        
        $user = auth()->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token; 
            
        return response()->json([
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'message' => "Login Successful!"
            ], 200);
    }

    public function logout(Request $request)
    {
        $user = auth()->guard('api')->user();
        $user->token()->revoke();
        return response()->json(['message' => 'Successfully logged out!']);
    }

    public function getMe()
    {
        $user = auth()->guard('api')->user();
        return response()->json(['user' => $user], 200);
    }
}
