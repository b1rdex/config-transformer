<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformer202112191\Symfony\Component\DependencyInjection\Compiler;

use ConfigTransformer202112191\Symfony\Component\DependencyInjection\Alias;
use ConfigTransformer202112191\Symfony\Component\DependencyInjection\ContainerBuilder;
use ConfigTransformer202112191\Symfony\Component\DependencyInjection\ContainerInterface;
use ConfigTransformer202112191\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use ConfigTransformer202112191\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use ConfigTransformer202112191\Symfony\Component\DependencyInjection\Reference;
/**
 * Overwrites a service but keeps the overridden one.
 *
 * @author Christophe Coevoet <stof@notk.org>
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Diego Saint Esteben <diego@saintesteben.me>
 */
class DecoratorServicePass extends \ConfigTransformer202112191\Symfony\Component\DependencyInjection\Compiler\AbstractRecursivePass
{
    public function process(\ConfigTransformer202112191\Symfony\Component\DependencyInjection\ContainerBuilder $container)
    {
        $definitions = new \SplPriorityQueue();
        $order = \PHP_INT_MAX;
        foreach ($container->getDefinitions() as $id => $definition) {
            if (!($decorated = $definition->getDecoratedService())) {
                continue;
            }
            $definitions->insert([$id, $definition], [$decorated[2], --$order]);
        }
        $decoratingDefinitions = [];
        foreach ($definitions as [$id, $definition]) {
            $decoratedService = $definition->getDecoratedService();
            [$inner, $renamedId] = $decoratedService;
            $invalidBehavior = $decoratedService[3] ?? \ConfigTransformer202112191\Symfony\Component\DependencyInjection\ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE;
            $definition->setDecoratedService(null);
            if (!$renamedId) {
                $renamedId = $id . '.inner';
            }
            $this->currentId = $renamedId;
            $this->processValue($definition);
            $definition->innerServiceId = $renamedId;
            $definition->decorationOnInvalid = $invalidBehavior;
            // we create a new alias/service for the service we are replacing
            // to be able to reference it in the new one
            if ($container->hasAlias($inner)) {
                $alias = $container->getAlias($inner);
                $public = $alias->isPublic();
                $container->setAlias($renamedId, new \ConfigTransformer202112191\Symfony\Component\DependencyInjection\Alias((string) $alias, \false));
                $decoratedDefinition = $container->findDefinition($alias);
            } elseif ($container->hasDefinition($inner)) {
                $decoratedDefinition = $container->getDefinition($inner);
                $public = $decoratedDefinition->isPublic();
                $decoratedDefinition->setPublic(\false);
                $container->setDefinition($renamedId, $decoratedDefinition);
                $decoratingDefinitions[$inner] = $decoratedDefinition;
            } elseif (\ConfigTransformer202112191\Symfony\Component\DependencyInjection\ContainerInterface::IGNORE_ON_INVALID_REFERENCE === $invalidBehavior) {
                $container->removeDefinition($id);
                continue;
            } elseif (\ConfigTransformer202112191\Symfony\Component\DependencyInjection\ContainerInterface::NULL_ON_INVALID_REFERENCE === $invalidBehavior) {
                $public = $definition->isPublic();
                $decoratedDefinition = null;
            } else {
                throw new \ConfigTransformer202112191\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException($inner, $id);
            }
            if ($decoratedDefinition && $decoratedDefinition->isSynthetic()) {
                throw new \ConfigTransformer202112191\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException(\sprintf('A synthetic service cannot be decorated: service "%s" cannot decorate "%s".', $id, $inner));
            }
            if (isset($decoratingDefinitions[$inner])) {
                $decoratingDefinition = $decoratingDefinitions[$inner];
                $decoratingTags = $decoratingDefinition->getTags();
                $resetTags = [];
                // container.service_locator and container.service_subscriber have special logic and they must not be transferred out to decorators
                foreach (['container.service_locator', 'container.service_subscriber'] as $containerTag) {
                    if (isset($decoratingTags[$containerTag])) {
                        $resetTags[$containerTag] = $decoratingTags[$containerTag];
                        unset($decoratingTags[$containerTag]);
                    }
                }
                $definition->setTags(\array_merge($decoratingTags, $definition->getTags()));
                $decoratingDefinition->setTags($resetTags);
                $decoratingDefinitions[$inner] = $definition;
            }
            $container->setAlias($inner, $id)->setPublic($public);
        }
    }
    /**
     * @param mixed $value
     * @return mixed
     */
    protected function processValue($value, bool $isRoot = \false)
    {
        if ($value instanceof \ConfigTransformer202112191\Symfony\Component\DependencyInjection\Reference && '.inner' === (string) $value) {
            return new \ConfigTransformer202112191\Symfony\Component\DependencyInjection\Reference($this->currentId, $value->getInvalidBehavior());
        }
        return parent::processValue($value, $isRoot);
    }
}
