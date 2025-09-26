<?php

namespace App\LogicLayer;

use App\LogicLayer\Contracts\BaseLogic;
use App\LogicLayer\Contracts\LogicResult;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

final class UserLogic extends BaseLogic
{
    public function __construct(protected UserRepositoryInterface $userRepository) { }

    public function login(string $email, string $password): LogicResult
    {
        $user = $this->userRepository->findByEmail($email);
        if (!$user || !Hash::check($password, $user->password)) {
            return $this->makeResult()->setMessage(__('errors.user.auth.invalid_credentials.message'))->setStatusCode
            (__('errors.user.auth.invalid_credentials.code'));
        }
        return $this->makeResult()->setMessage(__('messages.user.auth.login_success'))->setData($user->createToken('api-token')->plainTextToken);
    }
}