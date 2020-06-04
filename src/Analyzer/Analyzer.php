<?php

declare(strict_types=1);

namespace PZ\Analyzer;

class Analyzer
{
    /**
     * @var string
     */
    private $separator;

    /**
     * @var string
     */
    private $startSymbol;

    /**
     * @var string
     */
    private $endSymbol;

    public function __construct()
    {
        $this->separator = '.';
        $this->startSymbol = '';
        $this->endSymbol = '';
    }

    /**
     * @param array  $array
     * @param string $key
     *
     * @return array
     */
    public function findKeys(array $array, string $key)
    {
        return (new Finder())->findKeysInArray($array, $key);
    }

    /**
     * @param array $array
     *
     * @return int
     */
    public function findMaxDepth(array $array)
    {
        return (new Finder())->findMaxDepthOfArray($array);
    }
}
