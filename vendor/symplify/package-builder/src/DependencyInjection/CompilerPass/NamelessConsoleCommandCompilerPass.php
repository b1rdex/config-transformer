<?php

declare (strict_types=1);
namespace ConfigTransformer202110315\Symplify\PackageBuilder\DependencyInjection\CompilerPass;

use ConfigTransformer202110315\Symfony\Component\Console\Command\Command;
use ConfigTransformer202110315\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use ConfigTransformer202110315\Symfony\Component\DependencyInjection\ContainerBuilder;
use ConfigTransformer202110315\Symplify\PackageBuilder\Console\Command\CommandNaming;
/**
 * @see \Symplify\PackageBuilder\Tests\DependencyInjection\CompilerPass\NamelessConsoleCommandCompilerPassTest
 */
final class NamelessConsoleCommandCompilerPass implements \ConfigTransformer202110315\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
{
    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder
     */
    public function process($containerBuilder) : void
    {
        foreach ($containerBuilder->getDefinitions() as $definition) {
            $definitionClass = $definition->getClass();
            if ($definitionClass === null) {
                continue;
            }
            if (!\is_a($definitionClass, \ConfigTransformer202110315\Symfony\Component\Console\Command\Command::class, \true)) {
                continue;
            }
            $commandName = \ConfigTransformer202110315\Symplify\PackageBuilder\Console\Command\CommandNaming::classToName($definitionClass);
            $definition->addMethodCall('setName', [$commandName]);
        }
    }
}