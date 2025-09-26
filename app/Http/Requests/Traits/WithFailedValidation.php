<?php

namespace App\Http\Requests\Traits;

use App\Utils\ResponseUtil;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait WithFailedValidation
{
    /**
     * overwrite FormRequests hooks
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(ResponseUtil::fromValidationError($validator));
    }
}
