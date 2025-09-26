<?php

namespace App\LogicLayer\Contracts;

use Illuminate\Support\Facades\RateLimiter;

class BaseLogic
{

    /**
     * a simple limiter for limit some functions in logic layer
     *
     * @param string $key
     * @param int $seconds
     * @param int $maxAttempts
     * @param int $decaySeconds
     * @return LogicResult
     */
    public function limiter(string $key, int $seconds = 3, int $maxAttempts = 3, int $decaySeconds = 60): LogicResult
    {
        // making cache key
        $cacheKey = 'limiter:' . $key;

        // checking max tries
        if (RateLimiter::tooManyAttempts($cacheKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($cacheKey);
            return LogicResult::factory(__('errors.limiter', ['seconds' => $seconds]), 429);
        }

        // success try
        RateLimiter::hit($cacheKey, $decaySeconds);

        // 200 result = no error
        return LogicResult::factory();
    }

    /**
     * make a instance logic result
     *
     * @return LogicResult
     */
    public function makeResult(): LogicResult
    {
        return new LogicResult();
    }
}
