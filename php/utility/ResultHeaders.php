<?php
declare(strict_types=1);

// Nationalize SDK utility: result_headers

class NationalizeResultHeaders
{
    public static function call(NationalizeContext $ctx): ?NationalizeResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result) {
            if ($response && is_array($response->headers)) {
                $result->headers = $response->headers;
            } else {
                $result->headers = [];
            }
        }
        return $result;
    }
}
