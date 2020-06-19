<?php

namespace PZ\Finders;

class KeysFinder
{
    /**
     * @param array  $array
     * @param string $key
     * @param array  $path
     * @param array  $paths
     *
     * @return array
     */
    public function findKeysInArray(array $array, string $key, array $path = [], array $paths = [])
    {
        $currentKeys = array_keys($array);
        $startPath = $path;
        foreach ($currentKeys as $currentKey) {
            $path[] =  $currentKey;
            if ($currentKey === $key) {
                $paths[] = $path;
                if (is_array($array[$currentKey]) && !empty($array[$currentKey])) {
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

    /**
     * @param array $array
     * @param int   $depth
     * @param int   $maxDepth
     *
     * @return int
     */
    public function findMaxDepthOfArray(array $array, int $depth = 1, int $maxDepth = 0): int
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
