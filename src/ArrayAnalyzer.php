<?php
declare(strict_types=1);

namespace PZ;

use PZ\Analyzer\Analyzer;
use PZ\Finders\ScalarValueFinder;

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
    public static function findMaxDepth(array $array): int
    {
        $analyzer = new Analyzer();

        return $analyzer->findMaxDepth($array);
    }

    /**
     * @param array  $array
     * @param string $value
     *
     * @return array
     */
    public static function findStringValue(array $array, string $value)
    {
        return (new ScalarValueFinder())->findStringValue($array, $value);
    }

    /**
     * @param array $array
     * @param int   $value
     *
     * @return array
     */
    public static function findIntegerValue(array $array, int $value)
    {
        return (new ScalarValueFinder())->findIntegerValue($array, $value);
    }

    /**
     * @param array $array
     * @param bool  $value
     *
     * @return array
     */
    public static function findBoolValue(array $array, bool $value)
    {
        return (new ScalarValueFinder())->findBooleanValue($array, $value);
    }

    /**
     * @param array $array
     * @param float $value
     *
     * @return array
     */
    public static function findFloatValue(array $array, float $value)
    {
        return (new ScalarValueFinder())->findFloatValue($array, $value);
    }
    /**
     * @return Analyzer
     */
    public static function getAnalyzer(): Analyzer
    {
        return new Analyzer();
    }

    /**
     * @return ScalarValueFinder
     */
    public static function getScalarValueFinder(): ScalarValueFinder
    {
        return new ScalarValueFinder();
    }
}
