<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformer202202198\Symfony\Component\Cache\DependencyInjection;

use ConfigTransformer202202198\Symfony\Component\Cache\PruneableInterface;
use ConfigTransformer202202198\Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use ConfigTransformer202202198\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use ConfigTransformer202202198\Symfony\Component\DependencyInjection\ContainerBuilder;
use ConfigTransformer202202198\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use ConfigTransformer202202198\Symfony\Component\DependencyInjection\Reference;
/**
 * @author Rob Frawley 2nd <rmf@src.run>
 */
class CachePoolPrunerPass implements \ConfigTransformer202202198\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(\ConfigTransformer202202198\Symfony\Component\DependencyInjection\ContainerBuilder $container)
    {
        if (!$container->hasDefinition('console.command.cache_pool_prune')) {
            return;
        }
        $services = [];
        foreach ($container->findTaggedServiceIds('cache.pool') as $id => $tags) {
            $class = $container->getParameterBag()->resolveValue($container->getDefinition($id)->getClass());
            if (!($reflection = $container->getReflectionClass($class))) {
                throw new \ConfigTransformer202202198\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException(\sprintf('Class "%s" used for service "%s" cannot be found.', $class, $id));
            }
            if ($reflection->implementsInterface(\ConfigTransformer202202198\Symfony\Component\Cache\PruneableInterface::class)) {
                $services[$id] = new \ConfigTransformer202202198\Symfony\Component\DependencyInjection\Reference($id);
            }
        }
        $container->getDefinition('console.command.cache_pool_prune')->replaceArgument(0, new \ConfigTransformer202202198\Symfony\Component\DependencyInjection\Argument\IteratorArgument($services));
    }
}
