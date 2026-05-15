<?php
declare(strict_types=1);

// Nationalize SDK utility: feature_add

class NationalizeFeatureAdd
{
    public static function call(NationalizeContext $ctx, mixed $f): void
    {
        $ctx->client->features[] = $f;
    }
}
