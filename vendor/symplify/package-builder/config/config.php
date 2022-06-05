<?php

declare (strict_types=1);
namespace ConfigTransformer202206055;

use ConfigTransformer202206055\SebastianBergmann\Diff\Differ;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use ConfigTransformer202206055\Symplify\PackageBuilder\Console\Formatter\ColorConsoleDiffFormatter;
use ConfigTransformer202206055\Symplify\PackageBuilder\Console\Output\ConsoleDiffer;
use ConfigTransformer202206055\Symplify\PackageBuilder\Diff\Output\CompleteUnifiedDiffOutputBuilderFactory;
use ConfigTransformer202206055\Symplify\PackageBuilder\Reflection\PrivatesAccessor;
return static function (\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    $services->set(\ConfigTransformer202206055\Symplify\PackageBuilder\Console\Formatter\ColorConsoleDiffFormatter::class);
    $services->set(\ConfigTransformer202206055\Symplify\PackageBuilder\Console\Output\ConsoleDiffer::class);
    $services->set(\ConfigTransformer202206055\Symplify\PackageBuilder\Diff\Output\CompleteUnifiedDiffOutputBuilderFactory::class);
    $services->set(\ConfigTransformer202206055\SebastianBergmann\Diff\Differ::class);
    $services->set(\ConfigTransformer202206055\Symplify\PackageBuilder\Reflection\PrivatesAccessor::class);
};
