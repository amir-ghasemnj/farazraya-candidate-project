<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\LogicLayer\UserLogic;
use App\Utils\ResponseUtil;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * make api token for a user
     *
     * @param LoginRequest $request
     * @param UserLogic $userLogic
     * @return JsonResponse
     */
    public function login(LoginRequest $request, UserLogic $userLogic): JsonResponse
    {
        $validated = $request->validated();
        $result = $userLogic->login(
            $validated['email'],
            $validated['password']
        );
        return ResponseUtil::fromLogicResult($result, true);
    }
}
