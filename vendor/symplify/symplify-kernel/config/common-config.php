<?php

declare (strict_types=1);
namespace ConfigTransformer202106202;

use ConfigTransformer202106202\Symfony\Component\Console\Style\SymfonyStyle;
use ConfigTransformer202106202\Symfony\Component\DependencyInjection\ContainerInterface;
use ConfigTransformer202106202\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use ConfigTransformer202106202\Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory;
use ConfigTransformer202106202\Symplify\PackageBuilder\Parameter\ParameterProvider;
use ConfigTransformer202106202\Symplify\PackageBuilder\Reflection\PrivatesAccessor;
use ConfigTransformer202106202\Symplify\SmartFileSystem\FileSystemFilter;
use ConfigTransformer202106202\Symplify\SmartFileSystem\FileSystemGuard;
use ConfigTransformer202106202\Symplify\SmartFileSystem\Finder\FinderSanitizer;
use ConfigTransformer202106202\Symplify\SmartFileSystem\Finder\SmartFinder;
use ConfigTransformer202106202\Symplify\SmartFileSystem\SmartFileSystem;
use function ConfigTransformer202106202\Symfony\Component\DependencyInjection\Loader\Configurator\service;
return static function (\ConfigTransformer202106202\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    // symfony style
    $services->set(\ConfigTransformer202106202\Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory::class);
    $services->set(\ConfigTransformer202106202\Symfony\Component\Console\Style\SymfonyStyle::class)->factory([\ConfigTransformer202106202\Symfony\Component\DependencyInjection\Loader\Configurator\service(\ConfigTransformer202106202\Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory::class), 'create']);
    // filesystem
    $services->set(\ConfigTransformer202106202\Symplify\SmartFileSystem\Finder\FinderSanitizer::class);
    $services->set(\ConfigTransformer202106202\Symplify\SmartFileSystem\SmartFileSystem::class);
    $services->set(\ConfigTransformer202106202\Symplify\SmartFileSystem\Finder\SmartFinder::class);
    $services->set(\ConfigTransformer202106202\Symplify\SmartFileSystem\FileSystemGuard::class);
    $services->set(\ConfigTransformer202106202\Symplify\SmartFileSystem\FileSystemFilter::class);
    $services->set(\ConfigTransformer202106202\Symplify\PackageBuilder\Parameter\ParameterProvider::class)->args([\ConfigTransformer202106202\Symfony\Component\DependencyInjection\Loader\Configurator\service(\ConfigTransformer202106202\Symfony\Component\DependencyInjection\ContainerInterface::class)]);
    $services->set(\ConfigTransformer202106202\Symplify\PackageBuilder\Reflection\PrivatesAccessor::class);
};