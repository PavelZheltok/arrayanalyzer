<?php
declare(strict_types=1);

namespace PZ;

use PZ\Analyzer\Analyzer;

class ArrayAnalyzer
{
    /**
     * @param array  $array
     * @param string $key
     *
     * @return array
     */
    public static function findKeysPaths(array $array, string $key): array
    {
        $analyzer = new Analyzer();

        return $analyzer->findKeys($array, $key);
    }

    /**
     * @param $array
     *
     * @return int
     */
    public static function findMaxDepth($array): int
    {
        $analyzer = new Analyzer();

        return $analyzer->findMaxDepth($array);
    }

    /**
     * @return Analyzer
     */
    public static function analyzer(): Analyzer
    {
        return new Analyzer();
    }
}
