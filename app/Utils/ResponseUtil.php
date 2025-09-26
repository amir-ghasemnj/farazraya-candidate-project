<?php

namespace App\Utils;

use App\LogicLayer\Contracts\LogicResult;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

final class ResponseUtil
{
    /**
     * helper function for generating response from LogicResult
     *
     * @param LogicResult $result
     * @param bool $renderData
     * @return JsonResponse
     */
    public static function fromLogicResult(
        LogicResult $result,
        bool        $renderData = false): \Illuminate\Http\JsonResponse
    {
        return self::factory($result->getStatusCode(), $result->hasSomethingWrong() ? 403 : 200, $result->getMessage(),
            $result->getData(), $renderData);
    }

    /**
     * static structured response maker
     *
     * @param int $code
     * @param int $status
     * @param string|null $message
     * @param mixed|null $data
     * @param bool $renderData
     * @return JsonResponse
     */
    public static function factory(int         $code = 200,
                                   int $status = 200,
                                   string|null $message = null,
                                   mixed       $data = null,
                                   bool        $renderData = false): \Illuminate\Http\JsonResponse
    {
        return response(status: $status)->json([
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'payload' => $renderData ? $data : null,
        ]);
    }

    public static function fromValidationError(Validator $validator): \Illuminate\Http\JsonResponse
    {
        return self::factory(422, 422, 'fail', $validator->errors()->toArray(), true);
    }
}
