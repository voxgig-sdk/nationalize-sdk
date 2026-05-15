<?php
declare(strict_types=1);

// Nationalize SDK utility: prepare_body

class NationalizePrepareBody
{
    public static function call(NationalizeContext $ctx): mixed
    {
        if ($ctx->op->input === 'data') {
            return ($ctx->utility->transform_request)($ctx);
        }
        return null;
    }
}
