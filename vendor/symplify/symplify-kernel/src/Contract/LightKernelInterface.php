<?php

declare (strict_types=1);
namespace ConfigTransformer202112022\Symplify\SymplifyKernel\Contract;

use ConfigTransformer202112022\Psr\Container\ContainerInterface;
/**
 * @api
 */
interface LightKernelInterface
{
    /**
     * @param string[] $configFiles
     */
    public function createFromConfigs($configFiles) : \ConfigTransformer202112022\Psr\Container\ContainerInterface;
    public function getContainer() : \ConfigTransformer202112022\Psr\Container\ContainerInterface;
}
