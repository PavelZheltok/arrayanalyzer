<?php

namespace PZ;

use PZ\Analyzer\Analyzer;

class ArrayAnalyzer
{
    public static function findKeysPaths(array $array, string $key)
    {
        $analyzer = new Analyzer();
        return $analyzer->findKeys($array, $key);
    }

}
