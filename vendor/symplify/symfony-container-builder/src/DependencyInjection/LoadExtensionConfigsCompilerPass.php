<?php

declare (strict_types=1);
namespace ConfigTransformer202110314\Symplify\SymfonyContainerBuilder\DependencyInjection;

use ConfigTransformer202110314\Symfony\Component\DependencyInjection\Compiler\MergeExtensionConfigurationPass;
use ConfigTransformer202110314\Symfony\Component\DependencyInjection\ContainerBuilder;
/**
 * Mimics @see \Symfony\Component\HttpKernel\DependencyInjection\MergeExtensionConfigurationPass without dependency on
 * symfony/http-kernel
 */
final class LoadExtensionConfigsCompilerPass extends \ConfigTransformer202110314\Symfony\Component\DependencyInjection\Compiler\MergeExtensionConfigurationPass
{
    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder
     */
    public function process($containerBuilder) : void
    {
        $extensionNames = \array_keys($containerBuilder->getExtensions());
        foreach ($extensionNames as $extensionName) {
            $containerBuilder->loadFromExtension($extensionName, []);
        }
        parent::process($containerBuilder);
    }
}