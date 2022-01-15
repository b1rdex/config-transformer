<?php

declare (strict_types=1);
namespace ConfigTransformer202201158\Symplify\SymplifyKernel\Contract;

use ConfigTransformer202201158\Psr\Container\ContainerInterface;
/**
 * @api
 */
interface LightKernelInterface
{
    /**
     * @param string[] $configFiles
     */
    public function createFromConfigs(array $configFiles) : \ConfigTransformer202201158\Psr\Container\ContainerInterface;
    public function getContainer() : \ConfigTransformer202201158\Psr\Container\ContainerInterface;
}
