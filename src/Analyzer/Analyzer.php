<?php

declare(strict_types=1);

namespace PZ\Analyzer;

use PZ\Finders\KeysFinder;

class Analyzer
{
    /**
     * @param array  $array
     * @param string $key
     *
     * @return array
     */
    public function findKeys(array $array, string $key): array
    {
        return (new KeysFinder())->findKeysInArray($array, $key);
    }

    /**
     * @param array $array
     *
     * @return int
     */
    public function findMaxDepth(array $array): int
    {
        return (new KeysFinder())->findMaxDepthOfArray($array);
    }
}
