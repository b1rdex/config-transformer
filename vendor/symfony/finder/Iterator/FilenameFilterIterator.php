<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformer202112022\Symfony\Component\Finder\Iterator;

use ConfigTransformer202112022\Symfony\Component\Finder\Glob;
/**
 * FilenameFilterIterator filters files by patterns (a regexp, a glob, or a string).
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @extends MultiplePcreFilterIterator<string, \SplFileInfo>
 */
class FilenameFilterIterator extends \ConfigTransformer202112022\Symfony\Component\Finder\Iterator\MultiplePcreFilterIterator
{
    /**
     * Filters the iterator values.
     */
    public function accept() : bool
    {
        return $this->isAccepted($this->current()->getFilename());
    }
    /**
     * Converts glob to regexp.
     *
     * PCRE patterns are left unchanged.
     * Glob strings are transformed with Glob::toRegex().
     *
     * @param string $str Pattern: glob or regexp
     */
    protected function toRegex($str) : string
    {
        return $this->isRegex($str) ? $str : \ConfigTransformer202112022\Symfony\Component\Finder\Glob::toRegex($str);
    }
}
