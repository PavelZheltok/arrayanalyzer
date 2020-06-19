<?php
declare(strict_types=1);

namespace PZ\Finders;

class ScalarValueFinder
{
    /**
     * @param array $array
     * @param int   $value
     *
     * @return array
     */
    public function findIntegerValue(array $array, int $value): array
    {
        return $this->findValue($array, $value);
    }

    /**
     * @param array $array
     * @param float $value
     *
     * @return array
     */
    public function findFloatValue(array $array, float $value)
    {
        return $this->findValue($array, $value);
    }

    /**
     * @param array $array
     * @param bool  $value
     *
     * @return array
     */
    public function findBooleanValue(array $array, bool $value)
    {
        return $this->findValue($array, $value);
    }

    /**
     * @param array  $array
     * @param string $value
     *
     * @return array
     */
    public function findStringValue(array $array, string $value)
    {
        return $this->findValue($array, $value);
    }

    /**
     * @param array $array
     * @param       $value
     * @param array $path
     * @param array $paths
     *
     * @return array
     */
    private function findValue(array $array, $value, array $path = [], array $paths = [])
    {
        $currentKeys = array_keys($array);
        $startPath = $path;
        foreach ($currentKeys as $currentKey) {
            $path[] = $currentKey;
            if ($array[$currentKey] === $value) {
                $paths[] = $path;
                $path = $startPath;
                continue;
            }
            if (is_array($array[$currentKey]) && !empty($array[$currentKey])) {
                $paths = $this->findValue($array[$currentKey], $value, $path, $paths);
            }
            $path = $startPath;
        }

        return $paths;
    }
}
