<?php

declare (strict_types=1);
namespace ConfigTransformer202107069;

use ConfigTransformer202107069\PhpParser\BuilderFactory;
use ConfigTransformer202107069\PhpParser\NodeFinder;
use ConfigTransformer202107069\PhpParser\NodeVisitor\ParentConnectingVisitor;
use ConfigTransformer202107069\Symfony\Component\DependencyInjection\ContainerInterface;
use ConfigTransformer202107069\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use ConfigTransformer202107069\Symfony\Component\Yaml\Parser;
use ConfigTransformer202107069\Symplify\PackageBuilder\Parameter\ParameterProvider;
use ConfigTransformer202107069\Symplify\PackageBuilder\Reflection\ClassLikeExistenceChecker;
use function ConfigTransformer202107069\Symfony\Component\DependencyInjection\Loader\Configurator\service;
return static function (\ConfigTransformer202107069\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    $services->load('ConfigTransformer202107069\Symplify\PhpConfigPrinter\\', __DIR__ . '/../src')->exclude([__DIR__ . '/../src/HttpKernel', __DIR__ . '/../src/Dummy', __DIR__ . '/../src/Bundle', __DIR__ . '/../src/ValueObject/FullyQualifiedImport.php']);
    $services->set(\ConfigTransformer202107069\PhpParser\NodeFinder::class);
    $services->set(\ConfigTransformer202107069\Symfony\Component\Yaml\Parser::class);
    $services->set(\ConfigTransformer202107069\PhpParser\BuilderFactory::class);
    $services->set(\ConfigTransformer202107069\PhpParser\NodeVisitor\ParentConnectingVisitor::class);
    $services->set(\ConfigTransformer202107069\Symplify\PackageBuilder\Parameter\ParameterProvider::class)->args([\ConfigTransformer202107069\Symfony\Component\DependencyInjection\Loader\Configurator\service(\ConfigTransformer202107069\Symfony\Component\DependencyInjection\ContainerInterface::class)]);
    $services->set(\ConfigTransformer202107069\Symplify\PackageBuilder\Reflection\ClassLikeExistenceChecker::class);
};