<?php

declare (strict_types=1);
namespace ConfigTransformer2021111010;

use ConfigTransformer2021111010\PhpParser\BuilderFactory;
use ConfigTransformer2021111010\PhpParser\NodeFinder;
use ConfigTransformer2021111010\Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use ConfigTransformer2021111010\Symfony\Component\Yaml\Parser;
use ConfigTransformer2021111010\Symplify\ConfigTransformer\Console\ConfigTransfomerConsoleApplication;
use ConfigTransformer2021111010\Symplify\PackageBuilder\Reflection\ClassLikeExistenceChecker;
use ConfigTransformer2021111010\Symplify\PackageBuilder\Yaml\ParametersMerger;
use ConfigTransformer2021111010\Symplify\SmartFileSystem\FileSystemFilter;
return static function (\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    $services->load('ConfigTransformer2021111010\Symplify\ConfigTransformer\\', __DIR__ . '/../src')->exclude([__DIR__ . '/../src/Kernel', __DIR__ . '/../src/DependencyInjection/Loader', __DIR__ . '/../src/Enum', __DIR__ . '/../src/ValueObject']);
    // console
    $services->set(\ConfigTransformer2021111010\Symplify\ConfigTransformer\Console\ConfigTransfomerConsoleApplication::class);
    $services->alias(\ConfigTransformer2021111010\Symfony\Component\Console\Application::class, \ConfigTransformer2021111010\Symplify\ConfigTransformer\Console\ConfigTransfomerConsoleApplication::class);
    $services->set(\ConfigTransformer2021111010\PhpParser\BuilderFactory::class);
    $services->set(\ConfigTransformer2021111010\PhpParser\NodeFinder::class);
    $services->set(\ConfigTransformer2021111010\Symfony\Component\Yaml\Parser::class);
    $services->set(\ConfigTransformer2021111010\Symplify\SmartFileSystem\FileSystemFilter::class);
    $services->set(\ConfigTransformer2021111010\Symplify\PackageBuilder\Reflection\ClassLikeExistenceChecker::class);
    $services->set(\ConfigTransformer2021111010\Symplify\PackageBuilder\Yaml\ParametersMerger::class);
};
