<?php

declare (strict_types=1);
namespace ConfigTransformer2021082410\PhpParser\ErrorHandler;

use ConfigTransformer2021082410\PhpParser\Error;
use ConfigTransformer2021082410\PhpParser\ErrorHandler;
/**
 * Error handler that handles all errors by throwing them.
 *
 * This is the default strategy used by all components.
 */
class Throwing implements \ConfigTransformer2021082410\PhpParser\ErrorHandler
{
    /**
     * @param \PhpParser\Error $error
     */
    public function handleError($error)
    {
        throw $error;
    }
}
