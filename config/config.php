<?php

declare (strict_types=1);
namespace ConfigTransformer2021090310;

use ConfigTransformer2021090310\PhpParser\BuilderFactory;
use ConfigTransformer2021090310\PhpParser\NodeFinder;
use ConfigTransformer2021090310\Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use ConfigTransformer2021090310\Symfony\Component\Yaml\Parser;
use ConfigTransformer2021090310\Symplify\ConfigTransformer\Console\ConfigTransfomerConsoleApplication;
use ConfigTransformer2021090310\Symplify\ConfigTransformer\Provider\YamlContentProvider;
use ConfigTransformer2021090310\Symplify\PackageBuilder\Console\Command\CommandNaming;
use ConfigTransformer2021090310\Symplify\PackageBuilder\Reflection\ClassLikeExistenceChecker;
use ConfigTransformer2021090310\Symplify\PackageBuilder\Yaml\ParametersMerger;
use ConfigTransformer2021090310\Symplify\PhpConfigPrinter\Contract\YamlFileContentProviderInterface;
use ConfigTransformer2021090310\Symplify\SmartFileSystem\FileSystemFilter;
return static function (\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    $services->load('ConfigTransformer2021090310\Symplify\ConfigTransformer\\', __DIR__ . '/../src')->exclude([__DIR__ . '/../src/HttpKernel', __DIR__ . '/../src/DependencyInjection/Loader', __DIR__ . '/../src/ValueObject']);
    // console
    $services->set(\ConfigTransformer2021090310\Symplify\ConfigTransformer\Console\ConfigTransfomerConsoleApplication::class);
    $services->alias(\ConfigTransformer2021090310\Symfony\Component\Console\Application::class, \ConfigTransformer2021090310\Symplify\ConfigTransformer\Console\ConfigTransfomerConsoleApplication::class);
    $services->set(\ConfigTransformer2021090310\Symplify\PackageBuilder\Console\Command\CommandNaming::class);
    $services->set(\ConfigTransformer2021090310\PhpParser\BuilderFactory::class);
    $services->set(\ConfigTransformer2021090310\PhpParser\NodeFinder::class);
    $services->set(\ConfigTransformer2021090310\Symfony\Component\Yaml\Parser::class);
    $services->set(\ConfigTransformer2021090310\Symplify\SmartFileSystem\FileSystemFilter::class);
    $services->alias(\ConfigTransformer2021090310\Symplify\PhpConfigPrinter\Contract\YamlFileContentProviderInterface::class, \ConfigTransformer2021090310\Symplify\ConfigTransformer\Provider\YamlContentProvider::class);
    $services->set(\ConfigTransformer2021090310\Symplify\PackageBuilder\Reflection\ClassLikeExistenceChecker::class);
    $services->set(\ConfigTransformer2021090310\Symplify\PackageBuilder\Yaml\ParametersMerger::class);
};
