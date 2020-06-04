<?php
declare(strict_types=1);

namespace PZ\Helpers;

class KeyStringHelper
{
    /**
     * @var string
     */
    private $separator;

    /**
     * @param string $separator
     *
     * @return $this
     */
    public function setSeparator(string $separator)
    {
        $this->separator = $separator;

        return $this;
    }


}
