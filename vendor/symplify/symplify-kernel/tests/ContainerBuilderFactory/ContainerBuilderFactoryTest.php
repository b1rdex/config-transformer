<?php

declare (strict_types=1);
namespace ConfigTransformer202203034\Symplify\SymplifyKernel\Tests\ContainerBuilderFactory;

use ConfigTransformer202203034\PHPUnit\Framework\TestCase;
use ConfigTransformer202203034\Symplify\SmartFileSystem\SmartFileSystem;
use ConfigTransformer202203034\Symplify\SymplifyKernel\Config\Loader\ParameterMergingLoaderFactory;
use ConfigTransformer202203034\Symplify\SymplifyKernel\ContainerBuilderFactory;
final class ContainerBuilderFactoryTest extends \ConfigTransformer202203034\PHPUnit\Framework\TestCase
{
    public function test() : void
    {
        $containerBuilderFactory = new \ConfigTransformer202203034\Symplify\SymplifyKernel\ContainerBuilderFactory(new \ConfigTransformer202203034\Symplify\SymplifyKernel\Config\Loader\ParameterMergingLoaderFactory());
        $container = $containerBuilderFactory->create([__DIR__ . '/config/some_services.php'], [], []);
        $hasSmartFileSystemService = $container->has(\ConfigTransformer202203034\Symplify\SmartFileSystem\SmartFileSystem::class);
        $this->assertTrue($hasSmartFileSystemService);
    }
}
