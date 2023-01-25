<?php

namespace Gfoliver\Structure\Utils;

use Illuminate\Http\Response as IlluminateResponse;

class Response
{
    protected static function respond($status, $data, $code)
    {
        return response([
            'status'    => $status,
            'data'      => $data
        ], $code);
    }

    public static function success($data = null, $code = null)
    {
        return static::respond(true, $data, $code ? $code : IlluminateResponse::HTTP_OK);
    }

    public static function error($data = null, $code = null)
    {
        return static::respond(false, $data, $code ? $code : IlluminateResponse::HTTP_BAD_REQUEST);
    }
}
