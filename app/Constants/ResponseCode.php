<?php

namespace App\Constants;
use Illuminate\Http\Response;

class ResponseCode
{
    const FAILED = 0;
    const SUCCESS = 1;
    const MESSAGE = [
        Response::HTTP_OK => 'Success',
        Response::HTTP_NOT_FOUND => 'Not Found',
        Response::HTTP_BAD_REQUEST => 'Bad Request',
        Response::HTTP_UNAUTHORIZED => 'Unauthorized',
        Response::HTTP_FORBIDDEN => 'Forbidden',
        Response::HTTP_INTERNAL_SERVER_ERROR => 'Internal Server Error',
    ];
}
