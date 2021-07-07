<?php

declare (strict_types=1);
namespace ConfigTransformer2021070710;

use ConfigTransformer2021070710\PhpParser\ConstExprEvaluator;
use ConfigTransformer2021070710\PhpParser\NodeFinder;
use ConfigTransformer2021070710\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use ConfigTransformer2021070710\Symplify\PackageBuilder\Php\TypeChecker;
return static function (\ConfigTransformer2021070710\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->autowire()->autoconfigure()->public();
    $services->load('ConfigTransformer2021070710\Symplify\Astral\\', __DIR__ . '/../src')->exclude([__DIR__ . '/../src/HttpKernel', __DIR__ . '/../src/StaticFactory', __DIR__ . '/../src/ValueObject']);
    $services->set(\ConfigTransformer2021070710\PhpParser\ConstExprEvaluator::class);
    $services->set(\ConfigTransformer2021070710\Symplify\PackageBuilder\Php\TypeChecker::class);
    $services->set(\ConfigTransformer2021070710\PhpParser\NodeFinder::class);
};
