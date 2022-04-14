<?php

declare (strict_types=1);
namespace ConfigTransformer202204144\Symplify\SymplifyKernel\Contract\Config;

use ConfigTransformer202204144\Symfony\Component\Config\Loader\LoaderInterface;
use ConfigTransformer202204144\Symfony\Component\DependencyInjection\ContainerBuilder;
interface LoaderFactoryInterface
{
    public function create(\ConfigTransformer202204144\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder, string $currentWorkingDirectory) : \ConfigTransformer202204144\Symfony\Component\Config\Loader\LoaderInterface;
}
