<?php

namespace App\Http\Requests\Traits;

use App\Utils\ResponseUtil;
use Illuminate\Http\Exceptions\HttpResponseException;

trait WithFailedAuthorization
{
    /**
     * overwrite FormRequests hooks
     *
     * @return void
     * @throws HttpResponseException
     */
    protected function failedAuthorization(): void
    {
        throw new HttpResponseException(ResponseUtil::factory(401, 401, __('errors.unauthorized')));
    }
}
