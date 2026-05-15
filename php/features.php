<?php
declare(strict_types=1);

// Nationalize SDK feature factory

require_once __DIR__ . '/feature/BaseFeature.php';
require_once __DIR__ . '/feature/TestFeature.php';


class NationalizeFeatures
{
    public static function make_feature(string $name)
    {
        switch ($name) {
            case "base":
                return new NationalizeBaseFeature();
            case "test":
                return new NationalizeTestFeature();
            default:
                return new NationalizeBaseFeature();
        }
    }
}
