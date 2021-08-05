<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ConfigTransformer202108057\Symfony\Component\Config;

/**
 * A ConfigCacheFactory implementation that validates the
 * cache with an arbitrary set of ResourceCheckers.
 *
 * @author Matthias Pigulla <mp@webfactory.de>
 */
class ResourceCheckerConfigCacheFactory implements \ConfigTransformer202108057\Symfony\Component\Config\ConfigCacheFactoryInterface
{
    private $resourceCheckers = [];
    /**
     * @param iterable|ResourceCheckerInterface[] $resourceCheckers
     */
    public function __construct(iterable $resourceCheckers = [])
    {
        $this->resourceCheckers = $resourceCheckers;
    }
    /**
     * {@inheritdoc}
     * @param string $file
     * @param callable $callable
     */
    public function cache($file, $callable)
    {
        $cache = new \ConfigTransformer202108057\Symfony\Component\Config\ResourceCheckerConfigCache($file, $this->resourceCheckers);
        if (!$cache->isFresh()) {
            $callable($cache);
        }
        return $cache;
    }
}
