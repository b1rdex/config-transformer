<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformer202112141\Symfony\Component\VarExporter\Exception;

class NotInstantiableTypeException extends \Exception implements \ConfigTransformer202112141\Symfony\Component\VarExporter\Exception\ExceptionInterface
{
    public function __construct(string $type, \Throwable $previous = null)
    {
        parent::__construct(\sprintf('Type "%s" is not instantiable.', $type), 0, $previous);
    }
}
