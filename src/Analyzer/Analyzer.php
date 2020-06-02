<?php
declare(strict_types=1);
namespace PZ\Analyzer;

class Analyzer
{
    public function findKeys(array $array, string $key)
    {
        return $this->findKeysInArray($array, $key);
    }

    public function findMaxDepth(array $array)
    {
        return $this->findMaxDepthOfArray($array);
    }

    private function findKeysInArray(array $array, string $key, string $path = '', array $paths = [])
    {
        $currentKeys = array_keys($array);
        $startPath = $path;
        foreach ($currentKeys as $currentKey) {
            $path = $path . '.' . $currentKey;
            if ($currentKey === $key) {
                $paths[] = trim($path, '.');
                if (is_array($array[$currentKey]) && [] !== $array[$currentKey]) {
                    $paths = $this->findKeysInArray($array[$currentKey], $key, $path, $paths);
                    continue;
                }
                $path = $startPath;
                continue;
            }
            if (is_array($array[$currentKey]) && [] !== $array[$currentKey]) {
                $paths = $this->findKeysInArray($array[$currentKey], $key, $path, $paths);
            }

            $path = $startPath;
        }

        return $paths;
    }

    private function findMaxDepthOfArray(array $array, int $depth = 1, int $maxDepth = 0): int
    {
        foreach ($array as $item) {
            if (is_array($item)) {
                $maxDepth = $this->findMaxDepthOfArray($item, $depth + 1, $maxDepth);
            }

            $maxDepth = ($depth > $maxDepth) ? $depth : $maxDepth;
        }

        return $maxDepth;
    }
}
