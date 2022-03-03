<?php

declare (strict_types=1);
namespace ConfigTransformer202203034;

use ConfigTransformer202203034\Symplify\ConfigTransformer\Kernel\ConfigTransformerKernel;
use ConfigTransformer202203034\Symplify\SymplifyKernel\ValueObject\KernelBootAndApplicationRun;
$possibleAutoloadPaths = [
    // monorepo
    __DIR__ . '/../../../vendor/autoload.php',
    // after split package
    __DIR__ . '/../vendor/autoload.php',
    // dependency
    __DIR__ . '/../../../autoload.php',
];
foreach ($possibleAutoloadPaths as $possibleAutoloadPath) {
    if (\file_exists($possibleAutoloadPath)) {
        require_once $possibleAutoloadPath;
        break;
    }
}
$scoperAutoloadFilepath = __DIR__ . '/../vendor/scoper-autoload.php';
if (\file_exists($scoperAutoloadFilepath)) {
    require_once $scoperAutoloadFilepath;
}
$codeSnifferAutoload = \getcwd() . '/vendor/squizlabs/php_codesniffer/autoload.php';
if (\file_exists($codeSnifferAutoload)) {
    require_once $codeSnifferAutoload;
}
$kernelBootAndApplicationRun = new \ConfigTransformer202203034\Symplify\SymplifyKernel\ValueObject\KernelBootAndApplicationRun(\ConfigTransformer202203034\Symplify\ConfigTransformer\Kernel\ConfigTransformerKernel::class);
$kernelBootAndApplicationRun->run();
