<?php
declare(strict_types=1);

// Nationalize SDK utility: make_context

require_once __DIR__ . '/../core/Context.php';

class NationalizeMakeContext
{
    public static function call(array $ctxmap, ?NationalizeContext $basectx): NationalizeContext
    {
        return new NationalizeContext($ctxmap, $basectx);
    }
}
