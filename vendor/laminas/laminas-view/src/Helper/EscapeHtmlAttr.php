<?php

declare(strict_types=1);

namespace Laminas\View\Helper;

/**
 * Helper for escaping values
 */
class EscapeHtmlAttr extends Escaper\AbstractHelper
{
    /**
     * Escape a value for current escaping strategy
     *
     * @param  string $value
     * @return string
     */
    protected function escape($value)
    {
        return $this->getEscaper()->escapeHtmlAttr($value);
    }
}
