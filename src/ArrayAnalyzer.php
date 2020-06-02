<?php
declare(strict_types=1);

namespace PZ;

use PZ\Analyzer\Analyzer;

class ArrayAnalyzer
{
    public static function findKeysPaths(array $array, string $key)
    {
        $analyzer = new Analyzer();

        return $analyzer->findKeys($array, $key);
    }

    public static function findMaxDepth($array)
    {
        $analyzer = new Analyzer();

        return $analyzer->findMaxDepth($array);
    }
}
