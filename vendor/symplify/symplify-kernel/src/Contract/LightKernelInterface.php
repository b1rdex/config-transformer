<?php

declare (strict_types=1);
namespace ConfigTransformer202110314\Symplify\SymplifyKernel\Contract;

use ConfigTransformer202110314\Psr\Container\ContainerInterface;
/**
 * @api
 */
interface LightKernelInterface
{
    /**
     * @param string[] $configFiles
     */
    public function createFromConfigs($configFiles) : \ConfigTransformer202110314\Psr\Container\ContainerInterface;
    public function getContainer() : \ConfigTransformer202110314\Psr\Container\ContainerInterface;
}