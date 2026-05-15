<?php
declare(strict_types=1);

// Nationalize SDK utility: result_body

class NationalizeResultBody
{
    public static function call(NationalizeContext $ctx): ?NationalizeResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result && $response && $response->json_func && $response->body) {
            $result->body = ($response->json_func)();
        }
        return $result;
    }
}
