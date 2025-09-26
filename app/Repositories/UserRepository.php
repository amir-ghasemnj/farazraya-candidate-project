<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

final class UserRepository implements UserRepositoryInterface
{
    /**
     * repository dependency injector
     */
    public function __construct(protected User $model)
    {
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->query()->where('email', $email)->first();
    }

    public function findById(int $id): ?User
    {
        return $this->model->query()->where('id', $id)->first();
    }

    public function create(string $name, string $email, string $password): User
    {
        return $this->model->query()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }
}