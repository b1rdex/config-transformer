<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformer202109209\Symfony\Component\DependencyInjection\Compiler;

use ConfigTransformer202109209\Symfony\Component\DependencyInjection\Argument\TaggedIteratorArgument;
/**
 * Resolves all TaggedIteratorArgument arguments.
 *
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class ResolveTaggedIteratorArgumentPass extends \ConfigTransformer202109209\Symfony\Component\DependencyInjection\Compiler\AbstractRecursivePass
{
    use PriorityTaggedServiceTrait;
    /**
     * {@inheritdoc}
     * @param bool $isRoot
     */
    protected function processValue($value, $isRoot = \false)
    {
        if (!$value instanceof \ConfigTransformer202109209\Symfony\Component\DependencyInjection\Argument\TaggedIteratorArgument) {
            return parent::processValue($value, $isRoot);
        }
        $value->setValues($this->findAndSortTaggedServices($value, $this->container));
        return $value;
    }
}
